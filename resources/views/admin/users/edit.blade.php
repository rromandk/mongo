<x-app-layout>
        <x-slot name="header">
          <h2>Crear sss</h2>
        </x-slot>

<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf
    @method('PUT')

    <input name="name" value="{{ $user->name }}">
    <input name="email" value="{{ $user->email }}">
    <input name="password" placeholder="Nueva password (opcional)">

    <select name="role_id">
        @foreach($roles as $role)
            <option value="{{ $role->id }}"
                @if($user->role_id == $role->id) selected @endif>
                {{ $role->name }}
            </option>
        @endforeach
    </select>

    <button>Actualizar</button>
</form>


</x-app-layout>