<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pegawai extends Model
{
    use HasFactory;

    public $table = "pegawai";
    protected $fillable = ['nip', 'no_rekening', 'nama', 'jabatan'];

    public function selectPegawai()
    {
        $pg = DB::table('pegawai')
            ->select('id', 'nama')
            ->get();

        return $pg;
    }
}
