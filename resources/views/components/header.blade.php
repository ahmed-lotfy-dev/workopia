<header class="relative bg-blue-900 text-white p-4" x-data="{ open: false }">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="{{ url('/') }}">Workopia</a>
        </h1>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center space-x-4">
            <x-nav-link url="/" :active="request()->routeIs('home')">Home</x-nav-link>
            <x-nav-link url="/jobs" :active="request()->routeIs('jobs.index')">All Jobs</x-nav-link>

            @auth
                <x-nav-link url="/jobs/saved" :active="request()->routeIs('jobs.saved')">Saved Jobs</x-nav-link>
                <x-nav-link url="/dashboard" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                <!-- Logout Form -->
                <x-logout-button />
                <x-button-link url="/jobs/create" icon="edit">Create Job</x-button-link>
            @else
                <x-nav-link url="/login" :active="request()->routeIs('login')">Login</x-nav-link>
                <x-nav-link url="/register" :active="request()->routeIs('register')">Register</x-nav-link>
            @endauth
        </nav>

        <!-- Mobile Hamburger -->
        <button @click="open = !open" class="md:hidden text-white flex items-center">
            <i class="fa fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" @click.away="open = false" x-cloak
        class="md:hidden bg-blue-900 text-white absolute top-full left-0 w-full z-50 shadow-md space-y-2 py-4 px-4"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2">

        <x-nav-link url="/" :active="request()->routeIs('home')" :mobile="true">Home</x-nav-link>
        <x-nav-link url="/jobs" :active="request()->routeIs('jobs.index')" :mobile="true">All Jobs</x-nav-link>

        @auth
            <x-nav-link url="/jobs/saved" :active="request()->routeIs('jobs.saved')" :mobile="true">Saved Jobs</x-nav-link>
            <x-nav-link url="/dashboard" :active="request()->routeIs('dashboard')" :mobile="true">Dashboard</x-nav-link>
            <!-- Logout Form -->
            <x-logout-button />

            <x-button-link url="/jobs/create" icon="edit" :block="true">Create Job</x-button-link>
        @else
            <x-nav-link url="/login" :active="request()->routeIs('login')" :mobile="true">Login</x-nav-link>
            <x-nav-link url="/register" :active="request()->routeIs('register')" :mobile="true">Register</x-nav-link>
        @endauth
    </div>
</header>