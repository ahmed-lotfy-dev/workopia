@props(["title" => "Find Your Dream Job"])

<section class="hero relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
    <div class="overlay"></div>
    <div class="container mx-auto text-center z-10 p-10">
        <h2 class="text-4xl text-white font-bold mb-4">{{ $title }}</h2>
        <form class="block mx-5 md:mx-auto mt-10 md:space-x-2">
            <input type="text" name="keywords" placeholder="Keywords"
                class="w-full md:w-72 px-4 py-2 bg-white text-black border border-white focus:outline-none rounded-xs" />
            <input type="text" name="location" placeholder="Location"
                class="w-full md:w-72 px-4 py-3 mt-3 bg-white text-black border border-white focus:outline-none rounded-xs" />
            <button class="w-full md:w-auto mt-6 bg-blue-700 hover:bg-blue-600 text-white px-4 py-3 focus:outline-none rounded-xs">
                <i class="fa fa-search mr-1"></i> Search
            </button>
        </form>
    </div>
</section>