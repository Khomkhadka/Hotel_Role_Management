<aside x-data="{ open: false }"
       class="w-64 bg-white border-r border-gray-100 min-h-screen  flex flex-col">

    <!-- TOP SECTION -->
    <div class="flex-1">
        <!-- Logo (optional) -->
        <div class="h-[73px]
         flex items-center px-6 border-b">
            <span class="text-lg font-semibold">Menu</span>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col space-y-1 px-4 py-4">

            <x-nav-link
                :href="route('staff.dashboard')"
                :active="request()->routeIs('staff.dashboard')"
                class="block px-3  py-2 ">
                {{ __('Dashboard') }}
            </x-nav-link>

            @can('view-packages')
                <x-nav-link
                    :href="route('staff_packages.index')"
                    :active="request()->routeIs('staff_packages.index')"
                    class="block px-3 py-2">
                    {{ __('Packages') }}
                </x-nav-link>
            @endcan

            @can('view-customers')
                <x-nav-link
                    :href="route('staff_customers.index')"
                    :active="request()->routeIs('staff_customers.index')"
                    class="block px-3 py-2 text-lg ">
                    {{ __('Customers') }}
                </x-nav-link>
            @endcan

            @can('view-bookings')
                <x-nav-link
                    :href="route('staff_bookings.index')"
                    :active="request()->routeIs('staff_bookings.index')"
                    class="block px-3 py-2 text-lg">
                    {{ __('Bookings') }}
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
                            {{ strtoupper(substr(Auth::guard('staffs')->user()->name, 0, 1)) }}
                        </div>

                        <div class="text-left">
                            <p class="text-sm font-medium text-gray-800 leading-tight">
                                {{ Auth::guard('staffs')->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ Auth::guard('staffs')->user()->roles->pluck('name')->implode(', ') }}
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

                <form method="POST" action="{{ route('hotel.logout') }}">
                    @csrf
                    <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-600 hover:bg-red-50 flex items-center gap-2">
                        🚪 Log Out
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

</aside>