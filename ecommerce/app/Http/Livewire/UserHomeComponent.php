<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class UserHomeComponent extends Component
{
    public function render()
    {
        $shop_s = DB::table('shop_settings')->first();

        $new_arrivals = DB::table('products')
                        ->offset(0)
                        ->limit(7)
                        ->orderBy('id', 'desc')
                        ->where('active', 1)
                        ->get();


        $special_offers = DB::table('products')
                        ->offset(0)
                        ->limit(7)
                        ->where('special_discount', 1)
                        ->where('active', 1)
                        ->get();

        return view('livewire.user-home-component', compact('shop_s', 'new_arrivals', 'special_offers'))->layout('user.user_master');
    }
}
