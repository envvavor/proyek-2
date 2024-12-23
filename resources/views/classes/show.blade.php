<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-l font-semibold mb-1">Nama Kelas:</h1>
                    <h1 class="text-3xl font-semibold mb-4">{{ $class->name }}</h1>
                    <p>{{ $class->description }}</p>

                    <form method="GET" action="{{ route('classes.show', $class->id) }}" class="mb-4">
                        <label for="subject_id" class="block text-sm font-medium text-gray-700">Filter berdasarkan Mata Pelajaran:</label>
                        <select id="subject_id" name="subject_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="mt-2 px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                            Terapkan Filter
                        </button>
                    </form>
                    <h4 class="text-lg font-semibold mt-6 mb-6">Tugas untuk Kelas Ini:</h4>
                    @if($assignments->isEmpty())
                        <p class="text-gray-600">Tidak ada tugas ditemukan.</p>
                    @else
                        <ul class="flex flex-col">
                            @foreach ($assignments as $assignment)
                                <li class="w-full p-4 flex flex-col items-center hover:shadow-lg transition-shadow duration-300 ease-in-out mb-4 bg-gradient-to-b from-indigo-100 to-indigo-800 rounded-lg">
                                    <div class="flex flex-col w-full mb-4 p-4">
                                        <h5 class="text-lg font-semibold text-gray-700">Pengirim : {{ $assignment->teacher->name }}</h5>
                                        <h5 class="text-3xl font-semibold text-gray-700">Judul : {{ $assignment->title }}</h5>
                                        <h5 class="text-3xl font-semibold text-gray-700">Mata Pelajaran : {{ $assignment->subject->name }}</h5>
                                        <p class="text-gray-200 mt-2">Deskripsi :</br>{{ $assignment->description }}</p>
                                    </div>
                                    <div class="text-right w-full">
                                        <p class="text-sm text-gray-200"><strong>Kelas:</strong> {{ $assignment->class->name ?? '-' }}</p>
                                        <p class="text-sm text-gray-200"><strong>Batas Waktu:</strong> {{ $assignment->due_date }}</p>
                                    </div>
                                    <div class="mt-4 flex justify-end items-center space-x-2 w-full">
                                        <!-- Teks Edit -->
                                        <a href="{{ route('assignments.edit', $assignment->id) }}" class="text-blue-500 hover:underline">
                                            Edit
                                        </a>
                                        <!-- Teks Delete -->
                                        <form method="POST" action="{{ route('assignments.destroy', $assignment->id) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
