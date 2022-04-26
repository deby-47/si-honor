<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    public $table = "pegawai";
    protected $fillable = ['nip', 'no_rekening', 'nama', 'jabatan'];

    public $rules = array(
        'nip' => 'The :attribute field is required',
        'nama' => 'required',
        'jabatan' => 'required'
    );
}
