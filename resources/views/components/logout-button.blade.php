<form method="POST" action="{{ route('logout') }}" class="inline-flex items-center">
    @csrf
    <button type="submit" class="text-white px-3 py-1 flex items-center space-x-2 cursor-pointer hover:text-gray-200">
        <i class="fa fa-sign-out"></i>
        <span>Logout</span>
    </button>
</form>