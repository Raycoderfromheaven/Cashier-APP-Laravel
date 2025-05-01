<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Produk as ModelProduk;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Produk implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $col) {
           $kodedb = ModelProduk::where('kode', $col[1])->first();
            if(!$kodedb){
                $simpan= new ModelProduk();
                $simpan->kode = $col[0];
                $simpan->nama = $col[1];
                $simpan->harga = $col[2];
                $simpan->stok = 10;
                $simpan->save();
            }
            
        }
    }
}
