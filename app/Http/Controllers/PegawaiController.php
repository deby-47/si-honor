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
            ->orderBy('pegawai.nama', 'ASC')
            ->paginate(10);

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
        $pg->instansi = $request->instansi;
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

        DB::table('pegawai')->where('id', $request->id)->update([
            'nip' => $request->nip,
            'instansi' => $request->instansi,
            'nama' => $request->nama,
            'jabatan' => $request->get('jabatan')
        ]);

        return Redirect::to('/api/pegawai');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            if ($query != '') {
                $data = DB::table('pegawai')
                    ->where('nama', 'like', '%' . $query . '%')
                    ->orWhere('nip', 'like', '%' . $query . '%')
                    ->orWhere('instansi', 'like', '%' . $query . '%')
                    ->orWhere('jabatan', 'like', '%' . $query . '%')
                    ->orderBy('nama')
                    ->get();
            } else {
                $data = DB::table('pegawai')
                    ->orderBy('nip')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                    <tr>
                        <td>' . $row->nip . '</td>
                        <td>' . $row->nama . '</td>
                        <td>' . $row->kode . '</td>
                        <td>' . $row->instansi . '</td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                <tr>
                     <td align="center" colspan="5">No Data Found</td>
                 </tr>
                ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
               );
               
            echo json_encode($data);
        }
    }
}
