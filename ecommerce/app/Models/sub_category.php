<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'catID',
        'sub_cat_name',
        'url',
        'active',
    ];
}
