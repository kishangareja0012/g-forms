<aside class="w-60 h-screen bg-gray-800 text-white fixed top-0 z-[1000] transition-all"
    x-bind:class="$store.sidebar.on ? '-left-60 sm:left-0' : 'sm:-left-60 left-0'">
    <ul>
        <li class="p-6"><a href="" class="text-lg font-medium">{{ config('app.name') }}</a></li>
        <li class="text-xs font-medium text-gray-400 p-6 uppercase">home</li>
        <li>
            <a href="{{ route('dashboard.index') }}" class="flex items-center space-x-4 text-sm py-2 px-6 {{ (getRouteName() === 'dashboard.index') ? 'text-sky-300' : 'text-gray-300' }}">
                <x-icons-dark.home />
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('forms.index') }}" class="flex items-center space-x-4 text-sm py-2 px-6 {{ (getRouteName() === 'forms.index') ? 'text-sky-300' : 'text-gray-300' }}">
                <x-icons-dark.adjustments />
                <span>Forms</span>
            </a>
        </li>
        <li class="text-xs font-medium text-gray-400 p-6 uppercase">settting</li>
        <li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="flex items-center space-x-4 text-sm py-2 px-6 text-red-300">
                    <x-icons-dark.logout />
                    <span>Logout</span>
                </button>
            </form>
        </li>
    </ul>
</aside>
