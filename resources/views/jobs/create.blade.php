<x-layout>
    <x-slot name="title">Create Job</x-slot>

    <div
        class="bg-gray-300 rounded-xl p-10 [&_input]:rounded-md [&_input]:border-black [&_input]:border-2 [&_input]:px-4 [&_input]:py-2">
        <h1 class="text-xl mb-3">Create Job</h1>

        <form action="/jobs" method="POST" class="flex flex-col gap-3">
            @csrf
            <div>
                <input type="text" name="title" placeholder="title" id="title" value="{{ old("title") }}">
                @error("title")
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div>
                <input type="text" name="description" placeholder="description" id="description" value="{{ old("description") }}">
                @error("description")
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit"
                class="mr-auto mt-5 bg-blue-500 px-6 py-3 rounded-xl text-white hover:text-blue-300">Submit</button>
        </form>
    </div>
</x-layout>