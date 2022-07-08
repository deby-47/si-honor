<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Transaksi;
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
        $jabatan = DB::table('pegawai')
            ->where('id', '=', $request->input('id_pegawai'))
            ->value('jabatan');
        $max = DB::table('jabatan')
            ->where('id_jbt', '=', $jabatan)
            ->value('max_kuota');
        $latest = DB::table('transaksi')
            ->where('id_pegawai', '=', $request->input('id_pegawai'))
            ->orderBy('created_at', 'DESC')->limit(1)
            ->where('status', '=', 1)
            ->value('kuota');
        $empty = DB::table('transaksi')
            ->where('id_pegawai', '=', $request->input('id_pegawai'))
            ->where('status', '=', 1)
            ->get();
        $check_deskripsi = DB::table('transaksi')
            ->select('deskripsi')
            ->where('id_pegawai', '=', $request->input('id_pegawai'))
            ->where('deskripsi', '=', $request->input('deskripsi'))
            ->where('status', '=', 1)
            ->get();

        $trx = new Transaksi;
        $trx->id_pegawai = $request->input('id_pegawai');
        Session::put('id_pgs', $trx->id_pegawai);
        Session::save();

        $trx->id_jabatan = $jabatan;
        $trx->no_sk = $request->no_sk;
        $trx->no_spm = $request->no_spm;
        $trx->deskripsi = $request->deskripsi;
        $trx->keterangan = $request->keterangan;
        $trx->jumlah = $request->jumlah;
        $trx->tanggal_penerimaan = $request->input('tanggal_penerimaan');
        $trx->kuota = $empty->isEmpty() ? $max - 1 : ($check_deskripsi->isEmpty() ? $latest - 1 : $latest);

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
            'no_sk' => 'required',
        ];
        $msg = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $msg);

        DB::table('transaksi')->where('id_trx', $request->id)->update([
            'no_sk' => $request->no_sk,
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

    public function getKuota($id)
    {
        $check_pg = DB::table('transaksi')->where('id_pegawai', '=', $id)->get();
        if (!$check_pg->isEmpty()) 
        {
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

        return response()->json($latest);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pg = DB::table('pegawai')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->pluck('id');
        $transaksi = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('pegawai', 'pegawai.id', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
            ->whereIn('id_pegawai', collect($pg))
            ->orderBy('transaksi.kuota', 'ASC')
            ->where('transaksi.status', '=', 1)
            ->paginate();

        return view('layouts.transaksi.index', [
            'trx' => $transaksi,
        ]);
    }
}
