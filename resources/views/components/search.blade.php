<form method="GET" action="{{ route('jobs.search') }}" class="block mx-5 space-y-2 md:mx-auto md:space-x-2">
    <input type="text" name="keywords" placeholder="Keywords" value="{{ request('keywords') }}"
        class="w-full md:w-72 px-4 py-3 bg-white text-black border border-white focus:outline-none rounded-xs" />
    <input type="text" name="location" placeholder="Location" value="{{ request('location') }}"
        class="w-full md:w-72 px-4 py-3 bg-white text-black border border-white focus:outline-none rounded-xs" />
    <button class="w-full md:w-auto bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 focus:outline-none rounded-xs">
        <i class="fa fa-search mr-1"></i> Search
    </button>
</form>