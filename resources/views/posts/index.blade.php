<!-- resources/views/posts/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de Posts
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="/posts/create">Crear Post</a>

        <ul class="mt-4">
            @foreach ($posts as $post)
                <li class="mb-2">
                    {{ $post->title }}

                    <a href="/posts/{{ $post->id }}">Ver</a>
                     @can('update', $post)
                        <a href="/posts/{{ $post->id }}/edit">Editar</a>
                    @endcan
              

                    <form action="/posts/{{ $post->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro?')">
                            Eliminar
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>