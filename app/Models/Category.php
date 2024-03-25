<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //informal way, no security
    // protected $guarded = [];

    protected $guarded = [
        'title',
        'slug',
        'text_color',
        'bg_color',
    ];

}
