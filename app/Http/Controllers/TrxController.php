<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class TrxController extends Controller
{
    public function index()
    {
        $trx = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('jabatan_tim', 'transaksi.id_tim', '=', 'jabatan_tim.id_tim')
            ->join('pegawai', 'pegawai.id', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
            ->orderBy('transaksi.id_trx', 'ASC')
            ->where('transaksi.status', '=', 1)
            ->paginate(10);

        return view('layouts.transaksi.index', [
            'trx' => $trx,
        ]); //return with view
    }

    public function create()
    {
        return view('layouts.transaksi.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'pegawai' => 'numeric',
            'tim' => 'numeric',
            'bulan' => 'required|numeric',
            'jumlah_kotor' => 'required|numeric',
        ];

        $msg = [
            'pegawai.numeric' => 'Pegawai harus dipilih',
            'tim.numeric' => 'Jabatan dalam Tim harus dipilih.',
            'bulan.required' => 'Bulan harus diisi.',
            'jumlah_kotor.required' => 'Jumlah harus diisi.',
            'bulan.numeric' => 'Bulan harus berupa angka.',
            'jumlah_kotor.numeric' => 'Jumlah harus berupa angka.'
        ];

        $this->validate($request, $rules, $msg);

        $jabatan = DB::table('pegawai')
            ->where('id', '=', $request->input('pegawai'))
            ->value('jabatan');
        $max = DB::table('jabatan')
            ->where('id_jbt', '=', $jabatan)
            ->value('max_kuota');
        $latest = DB::table('transaksi')
            ->where('id_pegawai', '=', $request->input('pegawai'))
            ->orderBy('created_at', 'DESC')->limit(1)
            ->where('status', '=', 1)
            ->value('kuota');
        $empty = DB::table('transaksi')
            ->where('id_pegawai', '=', $request->input('pegawai'))
            ->where('status', '=', 1)
            ->get();
        $check_deskripsi = DB::table('transaksi')
            ->select('deskripsi')
            ->where('id_pegawai', '=', $request->input('pegawai'))
            ->where('deskripsi', '=', $request->input('deskripsi'))
            ->where('status', '=', 1)
            ->get();
        $golongan = DB::table('pegawai')
            ->select('golongan')
            ->where('id', '=', $request->input('pegawai'))
            ->get();
        $pph = str_contains($golongan, "IV") ? 15 : (str_contains($golongan, "III") ? 5 : 0);

        $trx = new Transaksi;
        $trx->id_pegawai = $request->input('pegawai');
        Session::put('id_pgs', $trx->id_pegawai);
        Session::save();

        $trx->id_jabatan = $jabatan;
        $trx->id_tim = $request->tim;
        $trx->no_sk = $request->no_sk;
        $trx->no_spm = $request->no_spm;
        $trx->deskripsi = $request->deskripsi;
        $trx->keterangan = $request->keterangan;
        $trx->bulan = $request->bulan;
        $trx->jumlah_kotor = $request->jumlah_kotor;
        $trx->jumlah = $request->jumlah_kotor - ($request->jumlah_kotor * $pph / 100);
        $trx->tanggal_penerimaan = $request->input('tanggal_penerimaan');

        if ($request->jumlah_kotor > 0)
        {
            $trx->kuota = $empty->isEmpty() ? $max - 1 : ($check_deskripsi->isEmpty() ? $latest - 1 : $latest);
        } else {
            $trx->kuota = $empty->isEmpty() ? $max : $latest;
        }
        
        if ($trx->kuota < 0) {
            $trx->save();
            alert()->html('Penerimaan Honorarium Melebihi Batas', '<a href="/export" target="_blank"><b>Download</b></a> riwayat penerimaan honorarium.', 'warning')->persistent(true);
            return view('layouts.transaksi.create')->with('id_pg', $trx->id_pegawai);
        }

        $trx->save();
        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.transaksi.create')->with('id_pg', $trx->id_pegawai);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $trx = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('jabatan_tim', 'transaksi.id_tim', '=', 'jabatan_tim.id_tim')
            ->join('pegawai', 'pegawai.id', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
            ->where('transaksi.status', '=', 1)
            ->where('transaksi.id_trx', '=', $id)
            ->get();

        return view('layouts.transaksi.edit', [
            'trx' => $trx
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'jabatan' => 'required',
            'bulan' => 'required|numeric',
            'jumlah_kotor' => 'required|numeric',
            'no_sk' => 'required'
        ];

        $msg = [
            'jabatan.required' => 'Jabatan dalam Tim harus dipilih.',
            'bulan.required' => 'Bulan harus diisi.',
            'jumlah_kotor.required' => 'Jumlah harus diisi.',
            'no_sk' => 'No SK harus diisi.',
            'bulan.numeric' => 'Bulan harus berupa angka.',
            'jumlah_kotor.numeric' => 'Jumlah harus berupa angka.'
        ];

        $this->validate($request, $rules, $msg);

        $golongan = DB::table('pegawai')
            ->select('golongan')
            ->where('nip', '=', $request->nip)
            ->get();
        $pph = str_contains($golongan, "IV") ? 15 : (str_contains($golongan, "III") ? 5 : 0);

        DB::table('transaksi')->where('id_trx', $request->id)->update([
            'no_sk' => $request->no_sk,
            'id_tim' => $request->get('jabatan'),
            'jumlah_kotor' => $request->jumlah_kotor,
            'jumlah' => $request->jumlah_kotor - ($request->jumlah_kotor * $pph / 100),
            'tanggal_penerimaan' => $request->tanggal_penerimaan
        ]);

        return Redirect::to('/trx');
    }

    public function destroy($id)
    {
        DB::table('transaksi')->where('id_trx', $id)->update([
            'status' => 0
        ]);

        return Redirect::to('/trx');
    }

    public function export()
    {
        $id = Session::get('id_pgs');
        return Excel::download(new TransaksiExport($id), 'riwayat_transaksi.xlsx');
    }

    public function exportPdf()
    {
        $search = Session::get('search');
        $trx = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('jabatan_tim', 'transaksi.id_tim', '=', 'jabatan_tim.id_tim')
            ->join('pegawai', 'pegawai.id', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
            ->where('deskripsi', 'LIKE', '%' . $search . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $search . '%')
            ->orWhere('no_spm', 'LIKE', '%' . $search . '%')
            ->orderBy('transaksi.id_tim', 'ASC')
            ->where('transaksi.status', '=', 1)
            ->get()->toArray();

        return PDF::loadView('layouts.transaksi.pdf', [
            'trx' => $trx,
        ])->setPaper('f4', 'landscape')->stream();
    }

    public function getKuota($id)
    {
        $check_pg = DB::table('transaksi')->where('id_pegawai', '=', $id)->get();
        $check_jabatan = DB::table('pegawai')->where('id', '=', $id)->value('jabatan');
        if ($check_jabatan == 7 || $check_jabatan == 8)
        {
            $latest = "";
        } else {
            if (!$check_pg->isEmpty()) {
                $latest = DB::table('transaksi')
                    ->where('id_pegawai', '=', $id)
                    ->orderBy('created_at', 'DESC')->limit(1)
                    ->where('status', '=', 1)
                    ->value('kuota');
            } else {
                $jabatan = DB::table('pegawai')
                    ->where('id', '=', $id)
                    ->value('jabatan');
                $latest = DB::table('jabatan')
                    ->where('id_jbt', '=', $jabatan)
                    ->value('max_kuota');
            }
        }
        

        return response()->json($latest);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('search', $search);
        Session::save();

        $transaksi = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('jabatan_tim', 'transaksi.id_tim', '=', 'jabatan_tim.id_tim')
            ->join('pegawai', 'pegawai.id', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->orWhere('deskripsi', 'LIKE', '%' . $search . '%')
            ->orWhere('keterangan', 'LIKE', '%' . $search . '%')
            ->orWhere('no_spm', 'LIKE', '%' . $search . '%')
            ->orderBy('transaksi.id_trx', 'ASC')
            ->where('transaksi.status', '=', 1)
            ->paginate(10);

        return view('layouts.transaksi.index', [
            'trx' => $transaksi,
        ]);
    }

    public function signee()
    {
        return view('layouts.transaksi.signee');
    }

    public function toPdf(Request $request)
    {
        Session::put('pa', $request->get('pa'));
        Session::save();
        Session::put('pptk', $request->get('pptk'));
        Session::save();
        Session::put('bendahara', $request->get('bendahara'));
        Session::save();

        return Redirect::to('/export_penerima');
    }
}
