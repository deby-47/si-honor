<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


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
        $check_sk = DB::table('transaksi')
                -> select('no_sk')
                -> where('id_pegawai', '=', $request->input('id_pegawai'))
                -> where('no_sk', '=', $request->input('no_sk'))
                -> where('status', '=', 1)
                -> get();
        $check_deskripsi = DB::table('transaksi')
                -> select('deskripsi')
                -> where('id_pegawai', '=', $request->input('id_pegawai'))
                -> where('deskripsi', '=', $request->input('deskripsi'))
                -> where('status', '=', 1)
                -> get();

        $trx = new Transaksi;
        $trx->id_pegawai = $request->input('id_pegawai');
        $trx->id_jabatan = $jabatan;
        $trx->no_sk = $request->no_sk;
        $trx->deskripsi = $request->deskripsi;
        $trx->jumlah = $request->jumlah;
        $trx->tanggal_penerimaan = $request->input('tanggal_penerimaan');
        $trx->kuota = $empty->isEmpty() ? $max - 1 : ($check_sk->isEmpty() && $check_deskripsi->isEmpty() ? $latest - 1 : $latest);
        
        if ($trx->kuota < 0) 
        {
            alert()->html('Gagal','<a href="/api/export" target="_blank"><b>Download</b></a> riwayat penerimaan honorarium.','error');
            return view('layouts.transaksi.create');
        }

        $trx->save();
        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.transaksi.create');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $trx = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('pegawai', 'pegawai.id_pg', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
            ->orderBy('transaksi.created_at', 'ASC')
            ->where('transaksi.status', '=', 1)
            ->where('transaksi.id_trx', '=', $id)
            ->get();
        
        return view('layouts.transaksi.edit', [
            'trx' => $trx,
        ]);
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
        return Excel::download(new TransaksiExport, 'riwayat_transaksi.xlsx');
    }
}
