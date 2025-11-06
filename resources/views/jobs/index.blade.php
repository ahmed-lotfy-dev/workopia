<x-layout>
    <h1>Available Jobs</h1>

    <ul class="">
        @forelse ($jobs as $job)
            <li> {{ $job }}</li>
        @empty
            <p>No Jobs Present</p>
        @endforelse
    </ul>
</x-layout>