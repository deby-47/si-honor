<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jabatan extends Model
{
    use HasFactory;

    public $table = "jabatan";
    protected $fillable = ['kode', 'max_kuota'];

    public function selectJbt()
    {
        $jbt = DB::table('jabatan')
            ->select('id_jbt', 'kode')
            ->get();
        return $jbt;
    }
}
