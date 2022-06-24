<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $table = 'transaksi';
    protected $fillable = ['id_pegawai', 'id_jabatan', 'no_sk', 'deskripsi', 'jumlah', 'tanggal_penerimaan', 'kuota'];
}
