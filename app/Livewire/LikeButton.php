<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class LikeButton extends Component
{
    //#[Reactive] // livewire 3.^ featured before we use .now() where we call the componen (post-item)
    public Post $post;

    public function toggleLike(){
        if(auth()->guest()) return $this->redirect(route('login'), true);

        $user = auth()->user();

        if($user->hasLiked($this->post)){
            $user->likes()->detach($this->post);
            return;
        }

        $user->likes()->attach($this->post);
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
