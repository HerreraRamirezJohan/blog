<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination; // Enables pagination methods for query pagination

    #[Url()]//Receive this parameter for url
    public $sort = 'desc';
    #[Url()]//Receive this parameter for url
    public $search = '';

    #[Computed()]
    public function posts(){
        return Post::published()
                    ->orderBy('published_at', $this->sort)
                    ->where('title', 'like', "%$this->search%")
                    ->paginate(3);//Show number of page
        return Post::published()->orderBy('published_at', $this->sort)->simplePaginate(3);//Onli show next&back buttons
    }

    #[On('search')]
    public function updateSearch($search){
        $this->search = $search;
    }

    public function setSort($sort){
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc'; //The user only can use this values
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
