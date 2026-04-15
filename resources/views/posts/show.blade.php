
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vista
        </h2>
    </x-slot>

<h2>{{ $post->title }}</h2>

<p>{{ $post->content }}</p>

@foreach($post->files as $file)
    <a href="{{ Storage::disk('s3')->url($file->path) }}" target="_blank">
        {{ $file->name }}
    </a>
@endforeach

<a href="/posts">Volver</a>
</x-app-layout>