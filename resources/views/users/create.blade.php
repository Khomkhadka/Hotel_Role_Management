<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create User
            </h2>
            <a href="{{ route('users.index') }}"
               class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-100  min-h-screen ">

        <div class="bg-white w-full p-8 rounded-lg shadow-lg mt-0">
            <h1 class="text-center text-2xl font-semibold mb-6 tracking-wide">
                Create User Form
            </h1>

            <form action="{{ route('users.store') }}" method="POST" class="space-y-4 ">
                @csrf

                <!-- Name -->
                
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" name="name"
                        value="{{ old('name') }}"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                        required>
                    </div>
                    
                    <!-- Email -->
                    <div class="w-full">
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                        required>
                    </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-medium mb-1">Address</label>
                    <input type="text" name="address"
                           value="{{ old('address') }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Contact -->
                <div>
                    <label class="block text-sm font-medium mb-1">Contact</label>
                    <input type="text" name="contact"
                           value="{{ old('contact') }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- DOB -->
                <div>
                    <label class="block text-sm font-medium mb-1">Date of Birth</label>
                    <input type="date" name="dob"
                           value="{{ old('dob') }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Roles -->
                <div>
                    <label class="block text-sm font-medium mb-1">Roles</label>
                    <select name="role"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                 {{-- <!-- hotel -->
                <div>
                    <label class="block text-sm font-medium mb-1">Related hotel ( * if selected Role satff)</label>
                    <select name="hotel_id">
                       <option value="">Select Role</option>
                                @foreach($roles as $role)
                                  <option value="{{ $role->name}}" {{ old('name') == $role->name ? 'selected' : '' }}>
                                    {{ $role->display_name }}
                                    </option>
                               @endforeach
                              </select>
                                 </div> --}}

                
                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>
            </div>

                <!-- Remark -->
                <div>
                    <label class="block text-sm font-medium mb-1">Remark</label>
                    <textarea name="remark" rows="2"
                              class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">{{ old('remark') }}</textarea>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800 transition">
                    Create User
                </button>
            </form>

            <!-- Error Box -->
            @if ($errors->any())
                <div class="mt-6 bg-black text-white p-4 rounded">
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
