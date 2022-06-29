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
            ->orderBy('transaksi.created_at', 'ASC')
            ->where('transaksi.status', '=', 1)
            ->get();

        return view('layouts.transaksi.index', [
            'trx' => $trx->sortBy('id_trx'),
        ]); //return with view
    }

    public function create()
    {
        return view('layouts.transaksi.create');
    }

    public function store(Request $request)
    {
        // if($request->input('id_pegawai')){
        //     Session::set('id_pg',$request->input('id_pegawai'));
        // }
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
        $trx->deskripsi = $request->deskripsi;
        $trx->jumlah = $request->jumlah;
        $trx->tanggal_penerimaan = $request->input('tanggal_penerimaan');
        $trx->kuota = $empty->isEmpty() ? $max - 1 : ($check_deskripsi->isEmpty() ? $latest - 1 : $latest);

        if ($trx->kuota < 0) 
        {
            alert()->html('Gagal', '<a href="/api/export" target="_blank"><b>Download</b></a> riwayat penerimaan honorarium.', 'error')->persistent(true);
            return view('layouts.transaksi.create');
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

        return Redirect::to('/api/trx');
    }

    public function destroy($id)
    {
        DB::table('transaksi')->where('id_trx', $id)->update([
            'status' => 0
        ]);

        return Redirect::to('/api/trx');
    }

    public function export()
    {
        $id = Session::get('id_pgs');
        return Excel::download(new TransaksiExport($id), 'riwayat_transaksi.xlsx');
    }
}
