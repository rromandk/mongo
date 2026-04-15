<!-- resources/views/posts/index.blade.php -->
<x-app-layout>
        <x-slot name="header">
          <h2>Agregar Institucion</h2>
        </x-slot>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/instituciones">
    @csrf

    <input type="text" name="nombre" placeholder="Título"><br><br>
    <textarea name="descripcion" placeholder="Contenido"></textarea><br><br>

    <button type="submit">Guardar</button>
</form>
</x-app-layout>