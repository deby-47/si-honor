<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return ["No", 
        "Nama Pegawai", 
        "Jabatan", 
        "Tanggal Penerimaan", 
        "Nomor SK", 
        "Deskripsi Kegiatan", 
        "Jumlah"];
    }

    public function collection()
    {
        return Transaksi::all();
    }
}
