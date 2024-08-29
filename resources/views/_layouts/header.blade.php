<header class="fixed left-0 top-0 z-[999] w-full border-b bg-white transition-all">
    <div class="mx-auto w-full max-w-screen-2xl p-6 sm:px-12" data-aos="fade">
        <div class="flex items-center justify-between">
            <a class="block" href="{{ route('forms.index') }}">{{ config('app.name') }}</a>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="flex items-center px-2 space-x-2 text-sm text-red-600">
                    <x-icons-dark.logout />
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</header>
