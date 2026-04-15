<x-app-layout>
        <x-slot name="header">
          <h2>Crear sss</h2>
        </x-slot>



        @if ($errors->any())
    <div style="background:red;color:white;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <input name="name" placeholder="Nombre">
    <input name="email" placeholder="Email">
    <input name="password" type="password">

    <select name="role_id">
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>

    <button>Crear</button>
</form>

</x-app-layout>