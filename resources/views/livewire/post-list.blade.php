{{-- A live wire component only can had ONE component html --}}
<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        {{-- Know what the user search --}}
        <div class="text-gray-800">
            @if ($search)
                Searching:  {{$search}}
            @endif
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500'}} py-4"
                wire:click="setSort('desc')">Latest</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500'}}"
                wire:click="setSort('asc')">Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post){{-- Is a computed component, we need use $this --}}
            <x-posts.post-item :post="$post" />
        @endforeach
    </div>
    <div class="my-3">{{--pagination conf display--}}
        {{$this->posts->onEachSide(1)->links()}}
    </div>
</div>
