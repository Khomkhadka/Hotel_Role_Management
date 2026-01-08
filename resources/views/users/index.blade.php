<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Users
            </h2>
            @can('create user')
            <a href="{{ route('users.create') }}"
               class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">
                Create User
            </a>
            @endcan
        </div>
    </x-slot>

   

        @if($users->isEmpty())
            <p class="text-center text-gray-500 py-10 text-sm">No users found.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Name</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Role</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Address</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Contact</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">DOB</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Remark</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ ucfirst($user->roles->first()->display_name ?? 'N/A') }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->address }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->contact }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $user->dob }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs
                                        {{ $user->status === 'active'
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-700">
                                    {{ $user->remark ?? '—' }}
                                </td>

                                <td class="px-4 py-3 flex space-x-2">
                                    {{-- @can('edit user') --}}
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="bg-gray-900 text-white px-3 py-1.5 rounded-md text-xs hover:bg-gray-700">
                                        Edit
                                    </a>
                                    {{-- @endcan --}}

                                    @can('delete user')
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure?')"
                                                class="bg-red-600 text-white px-3 py-1.5 rounded-md text-xs hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
   
</x-app-layout>
