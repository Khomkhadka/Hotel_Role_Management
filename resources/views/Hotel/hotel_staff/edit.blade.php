<x-hotel-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Staff
            </h2>
            <a href="{{ route('hotel_staffs.index') }}"
                class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
        </div>
    </x-slot>

    <div class="bg-gray-100 min-h-screen">

        <div class="bg-white w-full p-8 rounded-lg shadow-lg">
            <h1 class="text-center text-2xl font-semibold mb-6 tracking-wide">
                Hotel Form
            </h1>

            <form action="{{ route('hotel_staffs.update', $staff->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                    <!-- Hotel Name -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Staff Name</label>
                        <input type="text" name="name" value="{{ old('name', $staff->name) }}"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $staff->email) }}"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Address</label>
                        <input type="text" name="address" value="{{ old('address', $staff->address) }}"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                    </div>

                    <!-- Contact -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Contact</label>
                        <input type="text" name="contact" value="{{ old('contact', $staff->contact) }}"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Status</label>
                        <select name="status"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Role</label>
                        <select name="role"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                            required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ old('role', $role->name) == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium mb-1"> Reset Password (if need to change)</label>
                        <input type="password" name="password"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                    </div>

                    <!-- comform Password -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Comform New Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black">
                    </div>
                </div>

                <!-- Remark -->
                <div>
                    <label class="block text-sm font-medium mb-1">Remark</label>
                    <textarea name="remake" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-black"
                        rows="2">{{ old('remake') }}</textarea>
                </div>

                <!-- Hotel ID -->

                <input type="hidden" name="hotel_id" value="{{ $hotelId }}">



                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-black text-white py-2 rounded font-semibold hover:bg-gray-800 transition">
                    Update staff
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
</x-hotel-layout>
