<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiTokenManager extends Component
{
    public $createApiTokenForm = [];
    public $tokens; // Tambahkan properti $tokens

    // ... kode lainnya ...

    public function render()
    {
        // Ambil data token dari model User
        $this->tokens = auth()->user()->tokens;

        // Pass data token ke tampilan blade menggunakan compact()
        return view('livewire.api-token-manager', compact('tokens'));
    }

}
