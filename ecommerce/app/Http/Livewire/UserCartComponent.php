<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

class UserCartComponent extends Component
{
    public function render()
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);
        return view('livewire.user-cart-component', compact('cart_data'))->layout('user.user_master');
    }
}
