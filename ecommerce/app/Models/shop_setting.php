<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shop_setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_name',
        'logo',
        'address',
        'phone_1',
        'phone_2',
        'email',
        'facebook',
        'youtube',
        'instagram',
        'twitter',
        'linkden',
    ];
}
