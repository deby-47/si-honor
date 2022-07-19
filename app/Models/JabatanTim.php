<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JabatanTim extends Model
{
    use HasFactory;

    public $table = "jabatan_tim";
    protected $fillable = ['jabatan'];

    public function selectJbt()
    {
        $jbt = DB::table('jabatan_tim')
            ->select('id_tim', 'jbt_tim')
            ->get();
        return $jbt;
    }
}
