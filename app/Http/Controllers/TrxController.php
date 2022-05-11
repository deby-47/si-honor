<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class TrxController extends Controller
{
    public function index()
    {
        $trx = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('pegawai', 'pegawai.id', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
            ->orderBy('transaksi.created_at', 'ASC')
            ->get();

        return view('layouts.transaksi.index', [
            'trx' => $trx->sortBy('id'),
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
            ->value('kuota');
        $empty = DB::table('transaksi')
            ->where('id_pegawai', '=', $request->input('id_pegawai'))
            ->get();

        $trx = new Transaksi;
        $trx->id_pegawai = $request->input('id_pegawai');
        $trx->id_jabatan = $jabatan;
        $trx->no_sppd = $request->no_sppd;
        $trx->jumlah = $request->jumlah;
        $trx->kuota = ($empty->isEmpty()) ? ($max - 1) : ($latest - 1);
        $trx->tanggal_penerimaan = $request->input('tanggal_penerimaan');

        if ($trx->kuota < 0) {
            Alert::error('Gagal', 'Kuota penerimaan honor sudah tercapai.');
            return view('layouts.transaksi.create');
        }

        $trx->save();
        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return Redirect::to('/api/trx');
    }

    public function destroy($id)
    {
        Transaksi::find($id);
        DB::table('transaksi')->where('id', $id)->delete();

        return Redirect::to('/api/trx');
    }
}
