<x-layout>
    <div class="bg-gray-300 rounded-xl p-10 [&_input]:rounded-md [&_input]:border-black [&_input]:border-2 [&_input]:px-4 [&_input]:py-2">
        <h1 class="text-xl mb-3">Create Job</h1>

        <form action="/jobs" method="POST" class="flex flex-col gap-3">
            @csrf
            <input type="text" name="title" placeholder="title" id="title">
            <input type="text" name="description" placeholder="description" id="description">
            <button type="submit" class="mr-auto mt-5 bg-blue-500 px-6 py-3 rounded-xl text-white hover:text-blue-300">Submit</button>
        </form>
    </div>
</x-layout>