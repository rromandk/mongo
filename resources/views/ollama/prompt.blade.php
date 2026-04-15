<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded-lg">
        <h1 class="text-xl font-bold mb-4">Interact with Ollama</h1>

        <form method="POST" action="{{ route('ollama.generate') }}">
            @csrf
            <textarea name="prompt" rows="4" class="w-full p-2 border rounded" placeholder="Type your prompt...">{{ old('prompt', $prompt ?? '') }}</textarea>
            @error('prompt')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
            <button type="submit" class="mt-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Generate
            </button>
        </form>

        @isset($response)
            <div class="mt-6 p-4 bg-gray-100 rounded">
                <h2 class="font-semibold mb-2">Response:</h2>
                <p>{{ $response }}</p>
            </div>
        @endisset
    </div>
</x-app-layout>