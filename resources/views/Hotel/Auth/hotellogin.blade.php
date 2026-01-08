<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center px-4 sm:px-6 lg:px-8">

  <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 sm:p-8">

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-1">
      Welcome Back
    </h2>
    <p class="text-sm text-center text-gray-500 mb-6">
      Sign in to continue
    </p>

    <form action="{{ route('hotel.auth') }}" method="POST" class="space-y-4">
      @csrf

      <!-- Email -->
      <div>
        <label class="block text-xs font-medium text-gray-600 mb-1">Email Address</label>
        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          placeholder="you@example.com"
          class="w-full px-3 py-2.5 border rounded-lg text-sm
                 focus:outline-none focus:ring-2 border-gray-300 focus:ring-blue-500
                 @error('email') border-red-500 focus:ring-red-400 @enderror"
        >
        @error('email')
          <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div class="relative">
        <label class="block text-xs font-medium text-gray-600 mb-1">Password</label>

        <!-- Input with space for eye -->
        <input
          type="password"
          name="password"
          id="password"
          placeholder="••••••••"
          class="w-full px-3 py-2.5 pr-10 border rounded-lg text-sm
                 focus:outline-none focus:ring-2 border-gray-300 focus:ring-blue-500
                 @error('password') border-red-500 focus:ring-red-400 @enderror"
        >

        <!-- Eye icon inside input -->
        <button type="button"
                onclick="togglePassword()"
                class="absolute pl-8 top-1/2 right-2 -translate-y-1/3 text-gray-400 hover:text-blue-600 focus:outline-none">
          <!-- Eye Open -->
          <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
               viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                     c4.478 0 8.268 2.943 9.542 7
                     -1.274 4.057 -5.064 7 -9.542 7
                     -4.477 0 -8.268 -2.943 -9.542 -7z"/>
          </svg>

          <!-- Eye Closed -->
          <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
               viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M10.585 10.585A2 2 0 0012 14
                     a2 2 0 001.414-.586"/>
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                     c4.478 0 8.268 2.943 9.542 7
                     a9.97 9.97 0 01-1.249 2.592"/>
          </svg>
        </button>

        @error('password')
          <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Submit -->
      <button
        type="submit"
        class="w-full h-11 bg-black text-white rounded-lg font-medium
               hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
        Sign In
      </button>
    </form>
  </div>

  <!-- Toggle Password Script -->
  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      const eyeOpen = document.getElementById('eyeOpen');
      const eyeClosed = document.getElementById('eyeClosed');

      if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
      } else {
        input.type = 'password';
        eyeClosed.classList.add('hidden');
        eyeOpen.classList.remove('hidden');
      }
    }
  </script>
</body>
</html>
