<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tugas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas:</label>
                        <input type="text" id="title" name="title" value="{{ $assignment->title }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi:</label>
                        <textarea id="description" name="description" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500" required>{{ $assignment->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="class_id" class="block text-sm font-medium text-gray-700">Kelas:</label>
                        <select id="class_id" name="class_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ $assignment->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="subject_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran:</label>
                        <select id="subject_id" name="subject_id" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $assignment->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700">Batas Waktu:</label>
                        <input type="date" id="due_date" name="due_date" value="{{ $assignment->due_date }}" class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">Perbarui Tugas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
