<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk as ModelProduk;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as imporProduk;
use Livewire\WithPagination;

class Produk extends Component
{

    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;
    public $pilihanMenu = 'lihat';
    public $nama, $kode, $harga, $stok, $produkTerpilih, $fileExcel;

    // role kasir
    public function mount()
    {
        if (auth()->user()->role != 'admin') {
            abort(403);
        }
    }

    public function imporExcel()
    {
        Excel::import(new imporProduk, $this->fileExcel);
        $this->reset();
    }


    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode'],
            'stok' => 'required',
            'harga' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi!',
            'kode.required' => 'Kode Harus Diisi!',
            'kode.unique' => 'Kode Sudah Terdaftar!',
            'stok.required' => 'Stok Harus Diisi!',
            'harga.required' => 'Harga Harus Diisi!',
        ]);
        $simpan = new ModelProduk();
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok = $this->stok;
        $simpan->harga = $this->harga;
        $simpan->save();
        $this->reset(['nama', 'kode', 'stok', 'harga']);
        $this->pilihanMenu = 'lihat';
    }
    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode,' . $this->produkTerpilih->id],
            'stok' => 'required',
            'harga' => 'required',
        ], [
            'nama.required' => 'Nama Harus Diisi!',
            'kode.required' => 'Kode Harus Diisi!',
            'kode.unique' => 'Kode Sudah Terdaftar!',
            'stok.required' => 'Stok Harus Diisi!',
            'harga.required' => 'Harga Harus Diisi!',
        ]);
        $simpan = $this->produkTerpilih;
        $simpan->nama = $this->nama;
        $simpan->kode = $this->kode;
        $simpan->stok = $this->stok;
        $simpan->harga = $this->harga;
        $simpan->save();
        $this->reset(['nama', 'kode', 'stok', 'harga']);
        $this->pilihanMenu = 'lihat';
    }
    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        $this->reset();
        $this->pilihanMenu = 'lihat';
    }
    public function batal()
    {
        $this->reset();
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function render()
    {
        return view('livewire.produk', [
            'semuaProduk' => \App\Models\Produk::when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                        ->orWhere('kode', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy('nama')
                ->paginate(10)
        ]);
    }
}
