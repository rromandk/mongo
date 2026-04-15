<x-app-layout>

    <x-table title="Usuarios" :createRoute="route('admin.users.create')">
        {{-- HEAD --}}
        <x-slot name="head">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </x-slot>

        {{-- BODY --}}
        @foreach($users as $user)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $user->id }}</td>
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>

                <td class="px-4 py-2 text-right">
                      {{-- VER --}}
                        <a href="{{ route('admin.users.show', $user) }}"
                        class="text-blue-600 hover:text-blue-800">
                            👁️
                        </a>

                        {{-- EDIT --}}
                        <a href="{{ route('admin.users.edit', $user) }}"
                        class="text-yellow-600 hover:text-yellow-800">
                            ✏️
                        </a>

                    {{-- DELETE --}}
                    <form action="{{ route('admin.users.destroy', $user) }}"
                        method="POST"
                        onsubmit="return confirm('¿Eliminar?')">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-600 hover:text-red-800">
                            🗑️
                        </button>
    </form>

                </td>
            </tr>
        @endforeach

    </x-table>
</x-app-layout>