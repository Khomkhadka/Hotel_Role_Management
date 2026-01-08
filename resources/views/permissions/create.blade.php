<x-app-layout>
    <x-slot name="header">
         <div class="flex justify-between">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Permissions/create
        </h2>
        <a href="{{ route('permissions.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Back</a>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <form action={{ route('permissions.store') }} method="post">
                    @csrf
                 
                    <div>
                        <label for="text-lg font-medium">Name</label>
                    <div class="my-3">
                        <input type="text" value="{{ old('display_name') }}" name="display_name" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="enter permission">
                        @error('display_name')
                        <p class="text-red-400 font-medium">{{ $message}}</p>
                            
                        @enderror
                    </div>
                      <div class="mb-6">
                            <label for="guard_name" class="block text-gray-700 font-medium mb-2">Permission For</label>
                            <select name="guard_name"
                                    id="guard_name"
                                    class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                                <option value="staffs" {{ old('guard_name') === 'staffs' ? 'selected' : '' }}>Hotel</option>
                                <option value="web" {{ old('guard_name') === 'web' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('guard_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    <button class="bg-slate-700 text-sm rounded-md px-5 py-3 text-white">Submit</button>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>