<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowEntriesDropdown extends Component
{
    public $entries = 10; // Nilai default untuk jumlah data per halaman
    public $showEntriesOptions = [10, 25, 50, 100]; // Opsi "Show entries"

    public function render()
    {
        return view('livewire.show-entries-dropdown');
    }

    public function updatedEntries()
    {
        // Emit event to update the entries value in the parent component (KelolaBantuanHukum)
        $this->emitUp('updateEntries', $this->entries);
    }
}
