<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserRegisterComponent extends Component
{
    public function render()
    {
        return view('livewire.user-register-component')->layout('user.user_master');
    }
}
