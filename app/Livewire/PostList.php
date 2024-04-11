<?php

namespace App\Livewire;

use App\Models\Category;
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
    #[Url()]//Receive this parameter for url
    public $category = '';
    #[Url()]//Receive this parameter for url
    public $popular = false;

    #[Computed()]
    public function posts(){
        return Post::published()
                    ->when($this->activeCategory, function ($query){
                        $query->category($this->category);
                    })
                    ->when($this->popular, function($query){
                        $query->popular();
                    })
                    ->where('title', 'like', "%$this->search%")
                    ->orderBy('published_at', $this->sort)
                    ->paginate(3);//Show number of page
        return Post::published()->orderBy('published_at', $this->sort)->simplePaginate(3);//Onli show next&back buttons
    }
    #[Computed()]
    public function activeCategory(){
        return Category::where('slug', $this->category)->first();
    }

    public function clearFilters(){
        $this->search = '';
        $this->category = '';
        $this->resetPage();
    }

    #[On('search')]
    public function updateSearch($search){
        $this->search = $search;
        $this->resetPage();
    }

    public function setSort($sort){
        $this->sort = ($sort === 'desc') ? 'desc' : 'asc'; //The user only can use this values
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
