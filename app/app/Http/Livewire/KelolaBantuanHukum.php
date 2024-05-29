<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BantuanHukum;
use Livewire\WithPagination;

class KelolaBantuanHukum extends Component
{
    use WithPagination;

    public $entries = 10; // Nilai default untuk jumlah data per halaman

    protected $listeners = ['updateEntries'];

    public function updateEntries($value)
    {
        $this->entries = $value;
        $this->gotoPage(1); // Go to the first page when the entries per page is changed
    }

    public function render()
    {
        $bantuanHukum = BantuanHukum::paginate($this->entries);

        return view('kelola_bantuan_hukum.index', [
            'bantuanHukum' => $bantuanHukum,
        ]);
    }
}
