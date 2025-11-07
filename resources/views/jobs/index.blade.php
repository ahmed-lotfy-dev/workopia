<x-layout>
    <h1>Available Jobs</h1>

    <ul class="">
        @forelse ($jobs as $job)
            <li><a href="{{route('jobs.show', $job->id)}}">{{ $job->title }} </a> - {{ $job->description }}</li>
        @empty
            <p>No Jobs Present</p>
        @endforelse
    </ul>
</x-layout>