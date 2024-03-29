<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //informal way, no security
    // protected $guarded = [];

    protected $fillable = [
        'title',
        'slug',
        'text_color',
        'bg_color',
    ];

    //relations
    public function posts(){
        return $this->belongsToMany(Post::class); // We can delete the relation because we are use the convencion of laravel
    }
}
