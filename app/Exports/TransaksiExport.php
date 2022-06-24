<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return ["NIP", 
        "Nama Pegawai", 
        "Jabatan",
        "Nomor SK", 
        "Deskripsi", 
        "Jumlah", 
        "Tanggal Penerimaan"];
    }

    public function collection()
    {
        $res = DB::select(DB::raw("select pg.nip, pg.nama, jb.kode, trx.no_sk, trx.deskripsi, trx.jumlah, trx.tanggal_penerimaan
               from transaksi trx 
               join jabatan jb on trx.id_jabatan = jb.id_jbt
               join pegawai pg on trx.id_pegawai = pg.id
               where pg.status = 1 and trx.status = 1
               order by trx.created_at
        "));
        
        return collect($res);
    }
}
