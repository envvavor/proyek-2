<!-- File: resources/views/users/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Filter Berdasarkan Role -->
                    <form action="{{ route('users.index') }}" method="GET" class="mb-6 flex items-center space-x-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Filter Berdasarkan Role:</label>
                        <select name="role" id="role" class="border-gray-300 rounded-md shadow-sm">
                            <option value="">Semua Role</option>
                            <option value="1" {{ request()->role == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ request()->role == 2 ? 'selected' : '' }}>Guru</option>
                            <option value="3" {{ request()->role == 3 ? 'selected' : '' }}>murid</option>
                        </select>
                        <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Filter
                        </button>
                    </form>

                    <a href="{{ route('users.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl mb-10">
                        Create Users
                    </a>

                    <a href="{{ url('/export-users') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Export Excel
                    </a>

                    <!-- Tabel User -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">No</th>
                                    <th class="border border-gray-300 px-4 py-2">Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Email</th>
                                    <th class="border border-gray-300 px-4 py-2">Kelas</th>
                                    <th class="border border-gray-300 px-4 py-2">Role</th>
                                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="border-t border-gray-300 hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->class->name ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->roleText() }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <a href="{{ route('users.edit', $user) }}" class="text-blue-500 hover:underline">Edit</a> |
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" 
                                                    class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600"
                                                    onclick="confirmDelete({{ $user->id }})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">
                                            Tidak ada user ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
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
