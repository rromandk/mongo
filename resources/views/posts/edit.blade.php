<!-- resources/views/posts/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2>Editar Post</h2>
    </x-slot>
<form method="POST" action="/posts/{{ $post->id }}">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ $post->title }}"><br><br>
    <textarea name="content">{{ $post->content }}</textarea><br><br>

    <button type="submit">Actualizar</button>
</form>

</x-app-layout>