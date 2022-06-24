<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
            ->get();

        return view('layouts.pegawai.index', [
            'pg' => $pgs->sortBy('id'),
        ]); //return with view
    }

    public function create()
    {
        return view('layouts.pegawai.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nip' => 'required',
            'nama' => 'required',
            'jabatan' => 'required'
        ];
        $msg = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $msg);
        
        $pg = new Pegawai;
        $pg->nip = $request->nip;
        $pg->no_rekening = $request->no_rekening;
        $pg->nama = $request->nama;
        $pg->jabatan = $request->input('jabatan');
        $pg->save();

        return Redirect::to('/api/pegawai');
    }

    public function destroy($id)
    {
        Pegawai::find($id);
        DB::table('pegawai')->where('id', $id)->update([
            'status' => 0
        ]);

        return Redirect::to('/api/pegawai');
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
            'nip' => 'required',
            'nama' => 'required',
            'jabatan' => 'required'
        ];
        $msg = [
            'required' => 'The :attribute field is required.'
        ];

        $this->validate($request, $rules, $msg);
        dd($request->id);
        DB::table('pegawai')->where('id', $request->id)->update([
            'nip' => $request->nip,
            'no_rekening' =>$request->no_rekening,
            'nama' => $request->nama,
            'jabatan' => $request->input('jabatan')
        ]);

        return Redirect::to('/api/pegawai');
    }
}
