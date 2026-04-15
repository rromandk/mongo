{{-- 
Si no declarás @props, Blade:

NO crea la variable $createRoute
Entonces esta condición:
@if(!empty($createRoute))

👉 siempre da false → el botón no se renderiza

--}}

@props([
    'title' => null,
    'createRoute' => null
])

<div class="bg-white shadow rounded-lg p-6">

    <div class="mb-4 flex justify-between items-center">

        <h2 class="text-lg font-semibold">
            {{ $title ?? '' }}
        </h2>

        {{-- 👇 ESTE BLOQUE ES EL QUE TE FALTA --}}
        @if(!empty($createRoute))
            <a href="{{ $createRoute }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                + Nuevo
            </a>
        @endif

    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            
            <thead class="bg-gray-100 text-left text-sm text-gray-600">
                {{ $head }}
            </thead>

            <tbody class="text-sm text-gray-700">
                {{ $slot }}
            </tbody>

        </table>
    </div>

</div>