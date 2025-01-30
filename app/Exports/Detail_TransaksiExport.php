<?php

namespace App\Exports;

use App\Models\Detail_Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class Detail_TransaksiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Detail_Transaksi::all();
    }
}
