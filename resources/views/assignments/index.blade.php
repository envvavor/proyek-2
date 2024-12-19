<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Filter Mata Pelajaran -->
                    <form action="{{ route('assignments.index') }}" method="GET" class="mb-6 flex items-center space-x-4">
                        <label for="subject_id" class="block text-sm font-medium text-gray-700">Filter Berdasarkan Mata Pelajaran:</label>
                        <select name="subject_id" id="subject_id" class="border-gray-300 rounded-md shadow-sm">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" 
                                    {{ $subject->id == $subjectId ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Filter
                        </button>
                    </form>
                    <div class="pb-6 text-gray-900">
                        <a href="{{ route('assignments.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">
                            Create Assignment
                        </a>
                    </div>

                    <!-- Tabel Tugas -->
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">#</th>
                                    <th class="border border-gray-300 px-4 py-2">Pembuat</th>
                                    <th class="border border-gray-300 px-4 py-2">Judul</th>
                                    <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                                    <th class="border border-gray-300 px-4 py-2">Kelas</th>
                                    <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                                    <th class="border border-gray-300 px-4 py-2">Batas Waktu</th>
                                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($assignments as $assignment)
                                    <tr class="border-t border-gray-300 hover:bg-gray-100">
                                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $assignment->teacher->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $assignment->title }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $assignment->description }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $assignment->class->name ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $assignment->subject->name ?? '-' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $assignment->due_date }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <a href="{{ route('assignments.edit', $assignment) }}" class="text-blue-500 hover:underline">Edit</a> |
                                            <form id="delete-form-{{ $assignment->id }}" action="{{ route('assignments.destroy', $assignment) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <button type="button" 
                                                    class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600"
                                                    onclick="confirmDelete({{ $assignment->id }})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">
                                            Tidak ada tugas ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(assignmentId) {
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
                    document.getElementById(`delete-form-${assignmentId}`).submit();
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
