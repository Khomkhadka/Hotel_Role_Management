<aside
    x-data="{ open: false }"
    class="w-64 min-h-screen bg-white border-r border-gray-100 flex flex-col"
>

    <!-- SCROLLABLE TOP SECTION -->
    <div class="flex-1 overflow-y-auto">

        <!-- Logo / Title -->
        <div class="h-[83px] flex items-center px-6 border-b">
            <span class="text-lg font-semibold text-gray-800">
                Hotel Panel
            </span>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col space-y-1 px-4 py-4">

            <x-nav-link
                :href="route('hotel.dashboard')"
                :active="request()->routeIs('hotel.dashboard')"
                class="block px-3 py-2 rounded-md">
                {{ __('Dashboard') }}
            </x-nav-link>

               <x-nav-link
                :href="route('hotel_roles.index')"
                :active="request()->routeIs('hotel_roles.index')"
                class="block px-3 py-2 rounded-md">
                {{ __('Roles') }}
            </x-nav-link>

            <x-nav-link
                :href="route('hotel_packages.index')"
                :active="request()->routeIs('hotel_packages.index')"
                class="block px-3 py-2 rounded-md">
                {{ __('Packages') }}
            </x-nav-link>

            <x-nav-link
                :href="route('hotel_customers.index')"
                :active="request()->routeIs('hotel_customers.index')"
                class="block px-3 py-2 rounded-md">
                {{ __('Customers') }}
            </x-nav-link>

            <x-nav-link
                :href="route('hotel_bookings.index')"
                :active="request()->routeIs('hotel_bookings.index')"
                class="block px-3 py-2 rounded-md">
                {{ __('Bookings') }}
            </x-nav-link>


            <x-nav-link
                :href="route('hotel_staffs.index')"
                :active="request()->routeIs('hotel_staffs.index')"
                class="block px-3 py-2 rounded-md">
                {{ __('Staffs') }}
            </x-nav-link>

        </nav>
    </div>

    <!-- FIXED BOTTOM USER SECTION -->
    <div class="border-t px-4 py-3 bg-gray-50">
        <x-dropdown align="top" width="56">
            <x-slot name="trigger">
                <button
                    class="w-full flex items-center justify-between rounded-md px-3 py-2 hover:bg-gray-100 transition"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="h-9 w-9 flex items-center justify-center rounded-full bg-black text-white font-semibold"
                        >
                            {{ strtoupper(substr(Auth::guard('hotels')->user()->name, 0, 1)) }}
                        </div>
 
                        <div class="text-left">
                            <p class="text-sm font-medium text-gray-800 leading-tight">
                                {{ Auth::guard('hotels')->user()->name }}
                            </p>
                            {{-- <p class="text-xs text-gray-500">
                                {{ Auth::guard('hotels')->user()->roles->pluck('name')->implode(', ') }}
                            </p> --}}
                        </div>
                    </div>

                    <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link  :href="route('profile.edit')" class="flex items-center gap-2">
                    👤 Profile
                </x-dropdown-link>

                <div class="border-t my-1"></div>

                <form method="POST" action="{{ route('hotel.logout') }}">
                    @csrf
                    <x-dropdown-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-red-600 hover:bg-red-50 flex items-center gap-2"
                    >
                        🚪 Log Out
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>

</aside>