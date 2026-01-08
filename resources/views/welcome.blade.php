<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reception Management App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#1b1b18] text-[#FDFDFC]">

    <!-- Header -->
    <header class="w-full lg:max-w-6xl mx-auto flex items-center justify-between p-6 lg:p-8">
        <h1 class="text-2xl font-bold text-[#FDFDFC]">HotelManagePro</h1>
        <nav class="flex gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-sm border border-[#FDFDFC] hover:border-[#ccc]">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 rounded-sm border border-transparent hover:border-[#FDFDFC]">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2 rounded-sm border border-[#FDFDFC] hover:border-[#ccc]">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <!-- Hero Section -->
        <section class="text-center px-6 lg:px-0 py-20 lg:py-32 bg-gradient-to-r from-[#0a0a0a] to-[#1b1b18]"
        style="background-image: url('../../public/central-point.webp');">
        
        <h2 class="text-4xl lg:text-5xl font-extrabold mb-4 text-[#FDFDFC]">
            Streamline Your Hotel Reception
        </h2>
        <p class="text-lg lg:text-xl mb-8 text-[#ccc]">
            Manage reservations, staff, and operations effortlessly with a single platform designed for Admins, Managers, and Staff.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('hotel.login') }}" class="px-6 py-3 bg-[#FDFDFC] text-[#1b1b18] rounded-md hover:bg-[#ccc]">
                Get Started as Hotel
            </a>
            <a href="#features" class="px-6 py-3 border border-[#FDFDFC] rounded-md hover:bg-[#FDFDFC] hover:text-[#1b1b18]">
                Learn More
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 lg:py-32 px-6 lg:px-0 max-w-6xl mx-auto">
        <h3 class="text-3xl font-bold mb-12 text-center text-[#FDFDFC]">Key Features</h3>
        <div class="grid gap-12 lg:grid-cols-3">
            <div class="bg-[#0a0a0a] p-6 rounded-lg shadow-md hover:shadow-xl transition">
                <h4 class="text-xl font-semibold mb-3 text-[#FDFDFC]">Reservation Management</h4>
                <p class="text-[#ccc]">
                    Easily manage bookings, check-ins, and check-outs with real-time availability updates.
                </p>
            </div>
            <div class="bg-[#0a0a0a] p-6 rounded-lg shadow-md hover:shadow-xl transition">
                <h4 class="text-xl font-semibold mb-3 text-[#FDFDFC]">Staff Coordination</h4>
                <p class="text-[#ccc]">
                    Assign tasks, track shifts, and improve communication between your team.
                </p>
            </div>
            <div class="bg-[#0a0a0a] p-6 rounded-lg shadow-md hover:shadow-xl transition">
                <h4 class="text-xl font-semibold mb-3 text-[#FDFDFC]">Analytics & Reports</h4>
                <p class="text-[#ccc]">
                    Get detailed reports on occupancy, revenue, and staff performance to make data-driven decisions.
                </p>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section class="py-20 lg:py-32 px-6 lg:px-0 bg-[#FDFDFC] text-[#1b1b18]">
        <h3 class="text-3xl font-bold mb-12 text-center">Roles & Access</h3>
        <div class="grid gap-12 lg:grid-cols-3 max-w-6xl mx-auto">
            <div class="text-center p-6 bg-[#1b1b18] text-[#FDFDFC] rounded-lg shadow-md">
                <h4 class="text-xl font-semibold mb-2">Admin</h4>
                <p class="text-[#ccc]">
                    Full control over hotel settings, user management, and system configurations.
                </p>
            </div>
            <div class="text-center p-6 bg-[#1b1b18] text-[#FDFDFC] rounded-lg shadow-md">
                <h4 class="text-xl font-semibold mb-2">Hotel Manager</h4>
                <p class="text-[#ccc]">
                    Manage daily operations, reservations, staff assignments, and performance metrics.
                </p>
            </div>
            <div class="text-center p-6 bg-[#1b1b18] text-[#FDFDFC] rounded-lg shadow-md">
                <h4 class="text-xl font-semibold mb-2">Staff</h4>
                <p class="text-[#ccc]">
                    View tasks, handle check-ins/out, and manage room assignments efficiently.
                </p>
            </div>
        </div>
    </section>

    <!-- Call-to-Action -->
    <section class="py-20 lg:py-32 px-6 lg:px-0 text-center bg-gradient-to-r from-[#1b1b18] to-[#0a0a0a] text-[#FDFDFC]">
        <h3 class="text-3xl font-bold mb-6">Ready to Simplify Your Hotel Operations?</h3>
        <p class="mb-8 text-[#ccc]">
            Start your free trial today and experience the easiest way to manage your hotel.
        </p>
        <a href="{{ route('register') }}" class="px-8 py-4 bg-[#FDFDFC] text-[#1b1b18] rounded-md hover:bg-[#ccc] text-lg">
            Get Started
        </a>
    </section>

    <!-- Footer -->
    <footer class="py-10 text-center text-sm text-[#ccc] bg-[#1b1b18]">
        &copy; 2025 HotelManagePro. All rights reserved.
    </footer>

</body>
</html>
