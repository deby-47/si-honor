<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{
    public function kuota()
    {
        return $this->hasMany(Jabatan::class, 'id');
    }

    public function index()
    {
        $pgs = DB::table('pegawai')
            ->join('jabatan', 'pegawai.jabatan', '=', 'jabatan.id_jbt')
            ->where('pegawai.status', '=', 1)
            ->orderBy('pegawai.nama', 'ASC')
            ->paginate(10);
        
        Session::put('pg_url', request()->fullUrl());

        return view('layouts.pegawai.index', [
            'pg' => $pgs,
        ]); //return with view
    }

    public function create()
    {
        return view('layouts.pegawai.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nip' => 'required|numeric',
            'nama' => 'required',
            'golongan' => 'required',
            'title' => 'required',
            'jabatan' => 'required'
        ];
        $msg = [
            'nip.required' => 'NIP harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'golongan.required' => 'Golongan harus diisi.',
            'title.required' => 'Jabatan harus diisi.',
            'nip.numeric' => 'NIP harus berupa angka.'
        ];

        $this->validate($request, $rules, $msg);

        $pg = new Pegawai;
        $pg->nip = $request->nip;
        $pg->instansi = $request->instansi;
        $pg->nama = $request->nama;
        $pg->jabatan = $request->input('jabatan');
        $pg->golongan = $request->golongan;
        $pg->title = $request->title;
        $pg->save();

        Alert::success('Sukses!', 'Data berhasil tersimpan');
        return view('layouts.pegawai.create');
    }

    public function destroy($id)
    {
        Pegawai::find($id);
        DB::table('pegawai')->where('id', $id)->update([
            'status' => 0
        ]);

        return Redirect::to('/pegawai');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $pg = DB::table('pegawai')
            ->join('jabatan', 'pegawai.jabatan', '=', 'jabatan.id_jbt')
            ->where('pegawai.status', '=', 1)->where('id', $id)
            ->get();

        return view('layouts.pegawai.edit', [
            'pg' => $pg,
        ]); // returns with view
    }

    public function update(Request $request)
    {
        $rules = [
            'nip' => 'required|numeric',
            'nama' => 'required',
            'golongan' => 'required',
            'title' => 'required',
            'jabatan' => 'required'
        ];
        $msg = [
            'nip.required' => 'NIP harus diisi.',
            'nama.required' => 'Nama harus diisi.',
            'golongan.required' => 'Golongan harus diisi.',
            'title.required' => 'Jabatan harus diisi.',
            'jabatan.required' => 'Eselon harus diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
        ];

        $this->validate($request, $rules, $msg);
        
        DB::table('pegawai')->where('id', $request->id)->update([
            'nip' => $request->nip,
            'instansi' => $request->instansi,
            'nama' => $request->nama,
            'title' => $request->title,
            'golongan' => $request->golongan,
            'jabatan' => $request->get('jabatan')
        ]);

        return Redirect::to(Session::get('pg_url'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        Session::put('pg_url', request()->fullUrl());

        $pgs = DB::table('pegawai')
            ->join('jabatan', 'pegawai.jabatan', '=', 'jabatan.id_jbt')
            ->where('nama', 'LIKE', '%' . $search . '%')
            ->orWhere('jabatan.kode', 'LIKE', '%' . $search . '%')
            ->orWhere('pegawai.instansi', 'LIKE', '%' . $search . '%')
            ->where('pegawai.status', '=', 1)
            ->orderBy('pegawai.nama', 'ASC')
            ->paginate(10);

        return view('layouts.pegawai.index', [
            'pg' => $pgs,
        ]);
    }

    public function export($id)
    {
        return Excel::download(new TransaksiExport($id), 'riwayat_transaksi.xlsx');
    }
}
