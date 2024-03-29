@props(['post'])
<article class="[&:not(:last-child)]:border-b border-gray-100 pb-10">
    <div class="article-body grid grid-cols-12 gap-3 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center justify-center">
            <a href="">
                <img class="h-60 object-cover w-auto rounded-xl" src="{{$post->getThumbnailImage()}}" alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                <img class="w-7 h-7 rounded-full mr-3" src="{{$post->author->profile_photo_url}}" alt="avatar">
                <span class="mr-1 text-xs">{{$post->author->name}}</span>
                <span class="text-gray-500 text-xs">. {{$post->published_at->diffForHumans()}}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a href="http://127.0.0.1:8000/blog/first%20post">
                    {{$post->title}}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{$post->getExcerptBody()}}
            </p>
            <div class="article-actions-bar mt-6 flex items-center justify-between">
                <div class="flex gap-x-2">
                    @foreach ($post->categories as $category)
                    <x-badge wire:navigate href="{{ route('posts.index', ['category'=>$category->slug]) }}"
                        :bgColor="$category->bg_color"
                        :textColor="$category->text_color">
                        {{$category->slug}}
                    </x-badge>
                    @endforeach
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-500 text-sm">{{$post->getReadingTime()}} min read</span>
                    </div>
                </div>
                <div>
                    <livewire:like-button :key="$post->id" :post="$post" />
                    {{-- @livewire('like-button', ['key' => $post->id, 'post' => $post]) --}}
                </div>
            </div>
        </div>
    </div>
</article>
