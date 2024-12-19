<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Tugas Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('assignments.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <!-- Judul Tugas -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                                <input type="text" id="title" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Deskripsi Tugas -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                            </div>

                            <!-- Kelas -->
                            <div>
                                <label for="class_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select id="class_id" name="class_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Mata Pelajaran -->
                            <div>
                                <label for="subject_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                                <select id="subject_id" name="subject_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                                    <option value="" disabled selected>Pilih Mata Pelajaran</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Batas Waktu -->
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700">Batas Waktu</label>
                                <input type="date" id="due_date" name="due_date" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            </div>

                            <!-- Tombol Kirim -->
                            <div class="mt-4">
                                <button type="submit" class="w-full bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-300 ease-in-out">
                                    Buat Tugas
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
