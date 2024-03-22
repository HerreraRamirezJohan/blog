<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBar extends Component
{

    public $search = '';

    //Method for update while the user over of write
    // public function updatedSearch(){//use model.live in the component
    //     $this->dispatch('search', search : $this->search); //Call the method search when search is updating
    // }
    public function update(){
        $this->dispatch('search', search : $this->search); //Call the method search only when the user update
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
