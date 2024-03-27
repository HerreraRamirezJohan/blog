@props(['textColor', 'bgColor'])

<button {{ $attributes }} href="#" class="rounded-xl px-3 py-1 text-base" style="background-color: {{$bgColor}}; color: {{$textColor}}">
    {{$slot}}
</button>
