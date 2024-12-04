<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">Manage Users</h1>
                    <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Create User
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Table Wrapper for Responsiveness -->
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 px-4 py-2">Name</th>
                                <th class="border border-gray-300 px-4 py-2">Email</th>
                                <th class="border border-gray-300 px-4 py-2">Kelas</th>
                                <th class="border border-gray-300 px-4 py-2">Role</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $user->kelas }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($user->role == 1)
                                            Admin
                                        @elseif ($user->role == 2)
                                            Guru
                                        @elseif ($user->role == 3)
                                            Siswa
                                        @else
                                            Tidak Diketahui
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-0 py-2 text-center">
                                        <a href="{{ route('users.edit', $user) }}" 
                                           class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 mr-1">
                                            Edit
                                        </a>
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" 
                                                class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 mr-1"
                                                onclick="confirmDelete({{ $user->id }})">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- End of Table Wrapper -->
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${userId}`).submit();
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                }
            });
        }
    </script>

</x-app-layout>
