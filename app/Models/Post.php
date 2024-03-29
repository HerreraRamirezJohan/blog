<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured',
    ];

    //Cast
    public $casts = [
        'published_at' => 'datetime',
    ];
    //Filters
    public function scopePublished($query){
        $query->where('published_at', '<=', Carbon::now());
    }
    public function scopeFeatured($query){
        $query->where('featured', true);
    }
    public function scopeCategory($query, string $category){
        $query->whereHas('categories', function($query) use ($category){
            $query->where('slug', $category);
        });
    }
    //Relations
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function categories(){// You change the name to categories and remove the relations in belong
        return $this->belongsToMany(Category::class);
    }
    public function likes(){
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    //Business rules
    public function getExcerptBody(){
        return Str::limit(strip_tags($this->body), 150); //strip_tags remove html tags
    }
    public function getReadingTime(){
        $min = round(str_word_count($this->body) / 250) < 1 ; //The number 250 is the average that show google
        return $min < 1 ? 1 : $min;
    }
    public function getThumbnailImage(){
        $isUrl = str_contains($this->image, 'http');

        return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);
    }
}
