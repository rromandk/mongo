<!-- resources/views/posts/index.blade.php -->
<x-app-layout>
        <x-slot name="header">
          <h2>Crear Post</h2>
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

<form method="POST" action="/posts" enctype="multipart/form-data">
     @csrf

    <input type="text" name="title" placeholder="Título"><br><br>
    <textarea name="content" placeholder="Contenido"></textarea><br><br>
    <div class="mb-3">
                <label for="institucion_id" class="form-label">Institución (opcional)</label>
                <select class="form-control @error('institucion_id') is-invalid @enderror" 
                        id="institucion_id" name="institucion_id">
                    <option value="">Seleccione una institución...</option>
                    @foreach($instituciones as $institucion)
                        <option value="{{ $institucion->id }}" 
                            {{ old('institucion_id') == $institucion->id ? 'selected' : '' }}>
                            {{ $institucion->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('institucion_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
    </div>
    <input type="file" name="files[]" multiple>
    <button type="submit">Guardar</button>
</form>
</x-app-layout>