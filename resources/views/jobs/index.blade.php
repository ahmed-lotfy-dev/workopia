<x-layout>
    <div class="bg-blue-900 h-24 px-4 py-15 mb-10 flex justify-center items-center rounded">
        <x-search />
    </div>

    {{-- Back Button --}}
    @if(request()->has('keywords') || request()->has('location'))
        <a href="{{ route('jobs.index') }}"
            class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-md mb-4 inline-block"><i
                class="fa fa-arrow-left mr-1"></i> Back </a>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse ($jobs as $job)
            <x-job-card :job="$job" />
        @empty
            <p>No Jobs Present</p>
        @endforelse
    </div>
    {{-- Pagination Links --}}
    {{ $jobs->links() }}
</x-layout>