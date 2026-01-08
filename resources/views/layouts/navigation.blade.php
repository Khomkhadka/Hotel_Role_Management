<aside x-data="{ open: false }"
       class="w-64 min-h-screen bg-white border-r border-gray-100 flex flex-col">

    <!-- TOP SECTION -->
    <div class="flex-1">
        <!-- Logo -->
        <div class="h-[83px] flex items-center px-6 border-b">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
            </a>
             <span class="text-lg font-semibold text-gray-800">
                Admin Panel
            </span>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col space-y-1 px-4 py-4">

            <x-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
                class="block px-3 py-2 rounded-md">
                {{ __('Dashboard') }}
            </x-nav-link>

            @can('view-permissions')
                <x-nav-link
                    :href="route('permissions.index')"
                    :active="request()->routeIs('permissions.index')"
                    class="block px-3 py-2 rounded-md">
                    {{ __('Permissions') }}
                </x-nav-link>
            @endcan

            @can('view-roles')
                <x-nav-link
                    :href="route('roles.index')"
                    :active="request()->routeIs('roles.index')"
                    class="block px-3 py-2 rounded-md">
                    {{ __('Roles') }}
                </x-nav-link>
            @endcan

            @can('view users')
                <x-nav-link
                    :href="route('users.index')"
                    :active="request()->routeIs('users.index')"
                    class="block px-3 py-2 rounded-md">
                    {{ __('Users') }}
                </x-nav-link>
            @endcan

            @can('view-hotels')
                <x-nav-link
                    :href="route('hotels.index')"
                    :active="request()->routeIs('hotels.index')"
                    class="block px-3 py-2 rounded-md">
                    {{ __('Hotels') }}
                </x-nav-link>
            @endcan

        </nav>
    </div>

    <!-- BOTTOM USER SECTION -->
    <div class="border-t px-4 py-3 bg-gray-50 mb-6">
        <x-dropdown align="top" width="56">
            <x-slot name="trigger">
                <button class="w-full flex items-center justify-between rounded-md px-3 py-2 hover:bg-gray-100 transition">

                    <!-- User Info -->
                    <div class="flex items-center gap-3">
                        <!-- Avatar -->
                        <div class="h-9 w-9 flex items-center justify-center rounded-full bg-black text-white font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="text-left">
                            <p class="text-sm font-medium text-gray-800 leading-tight">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->roles->pluck('display_name')->implode(', ') }}
                            </p>
                        </div>
                    </div>

                    <!-- Chevron -->
                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                    </svg>
                </button>
            </x-slot>

            <!-- Dropdown Content -->
            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                    👤 Profile
                </x-dropdown-link>

                <div class="border-t my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center gap-2 text-red-600 hover:bg-red-50">
                        🚪 Log Out
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

</aside>