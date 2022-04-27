<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TrxController extends Controller
{
    public function index()
    {
        $trx = DB::table('transaksi')
            ->join('jabatan', 'transaksi.id_jabatan', '=', 'jabatan.id_jbt')
            ->join('pegawai', 'pegawai.id', '=', 'transaksi.id_pegawai')
            ->where('pegawai.status', '=', 1)
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
        $max = DB::table('jabatan')
                ->where('id_jbt', '=', $request->input('jabatan'))
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
        $trx->id_jabatan = $request->input('jabatan');
        $trx->no_sppd = $request->no_sppd;
        $trx->jumlah = $request->jumlah;
        $trx->kuota = ($empty->isEmpty()) ? ($max - 1) : ($latest - 1);
        $trx->tanggal_penerimaan = $request->input('tanggal_penerimaan');

        $trx->save();

        return Redirect::to('/api/trx');
    }
}
