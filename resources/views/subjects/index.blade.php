<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mata Pelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="pb-6 text-gray-900">
                        <a href="{{ route('subjects.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                            Create Subject
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">No</th>
                                    <th class="border border-gray-300 px-4 py-2">Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subjects as $subject)
                                    <tr class="border-t border-gray-300 hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $subject->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <a href="{{ route('subjects.edit', $subject) }}" class="text-blue-500 hover:underline">Edit</a> |
                                            <form id="delete-form-{{ $subject->id }}" action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" 
                                                    class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600"
                                                    onclick="confirmDelete({{ $subject->id }})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="border border-gray-300 px-4 py-2 text-center">
                                            Tidak ada mata pelajaran ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $subjects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(subjectId) {
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
                    document.getElementById(`delete-form-${subjectId}`).submit();
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