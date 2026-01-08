<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User
            </h2>
            <a href="{{ route('users.index') }}"
               class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">
                Back
            </a>
        </div>
    </x-slot>

    <div class="bg-gray-100 flex min-h-screen">

        <div class="bg-white w-full p-8 rounded-lg shadow-lg">
            <h1 class="text-center text-2xl font-semibold mb-6 tracking-wide">
                Edit User Form
            </h1>

            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
                    <!-- Name -->
                <div>
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input type="text" name="name"
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email"
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Address -->
                <div>
                    <label class="block text-sm font-medium mb-1">Address</label>
                    <input type="text" name="address"
                           value="{{ old('address', $user->address) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- Contact -->
                <div>
                    <label class="block text-sm font-medium mb-1">Contact</label>
                    <input type="text" name="contact"
                           value="{{ old('contact', $user->contact) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           required>
                </div>

                <!-- DOB -->
                <div>
                    <label class="block text-sm font-medium mb-1">Date of Birth</label>
                    <input type="date" name="dob"
                           value="{{ old('dob', $user->dob) }}"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                           >
                </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
                <!-- Password (Optional) -->
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Password <span class="text-gray-400 text-xs">(leave blank to keep current)</span>
                    </label>
                    <input type="password" name="password"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                </div>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2  gap-4">        
                <!-- Roles -->
                <div>
                    <label class="block text-sm font-medium mb-1">Roles</label>
                    <select name="role"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                        @foreach ($roles as $role )
                            <option value="{{ $role->name }}" {{ old('role',$user->roles->first()->name ?? 'role')== $role->name ? 'selected' : '' }}>
                           {{ ucfirst($role->display_name) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium mb-1">Status</label>
                    <select name="status"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>
               </div> 
                <!-- Remark -->
                <div>
                    <label class="block text-sm font-medium mb-1">Remark</label>
                    <textarea name="remark" rows="2"
                              class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">{{ old('remark', $user->remark) }}</textarea>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800 transition">
                    Update User
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
