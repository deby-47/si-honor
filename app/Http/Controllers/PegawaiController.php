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

        // $validation = $request->validate([
        //     'nip' => 'required',
        //     'nama' => 'required',
        //     'jabatan' => 'required'
        // ]);

        $pg = new Pegawai;
        $pg->nip = $request->nip;
        $pg->no_rekening = $request->no_rekening;
        $pg->nama = $request->nama;
        $pg->jabatan = $request->jabatan;
        $pg->save();

        return Redirect::to('/api/pegawai');
    }

    public function destroy($id)
    {
        $pg = Pegawai::find($id);
        $pg->delete();

        return Redirect::to('/api/pegawai');
    }
}
