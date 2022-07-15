<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class TransaksiExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, WithHeadings, ShouldAutoSize, WithStrictNullComparison, WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id) 
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        return ["NIP", 
        "Nama Pegawai", 
        "Jabatan",
        "Instansi",
        "Nomor SPM", 
        "Deskripsi", 
        "Keterangan",
        "Jumlah", 
        "Tanggal SPM",
        "Kuota Tersisa"];
    }

    public function collection()
    {
        $res = DB::select(DB::raw("select pg.nip, pg.nama, jb.kode, pg.instansi, trx.no_spm, trx.deskripsi, trx.keterangan,
               trx.jumlah, trx.tanggal_penerimaan, trx.kuota
               from transaksi trx 
               join jabatan jb on trx.id_jabatan = jb.id_jbt
               join pegawai pg on trx.id_pegawai = pg.id
               where pg.status = 1 and trx.status = 1 and trx.id_pegawai = :id_pg
               order by trx.kuota
        "), ['id_pg' => $this->id]);
        
        return collect($res);
    }
}
