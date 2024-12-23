<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Semua Submissions') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('submissions.indexAll') }}" class="bg-white shadow rounded-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="subject_id" class="block text-sm font-medium text-gray-700">Subject</label>
                    <select name="subject_id" id="subject_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->subject_id }}" {{ request('subject_id') == $subject->subject_id ? 'selected' : '' }}>{{ $subject->subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="class_id" class="block text-sm font-medium text-gray-700">Class</label>
                    <select name="class_id" id="class_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->class_id }}" {{ request('class_id') == $class->class_id ? 'selected' : '' }}>{{ $class->class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="assignment_id" class="block text-sm font-medium text-gray-700">Assignment</label>
                    <select name="assignment_id" id="assignment_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Assignment</option>
                        @foreach($assignments as $assignment)
                            <option value="{{ $assignment->id }}" {{ request('assignment_id') == $assignment->id ? 'selected' : '' }}>{{ $assignment->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300">
                    Apply Filters
                </button>
            </div>
        </form>

        <!-- Submissions Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                        <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($submissions as $submission)
                        <tr>
                            <td class="py-4 px-6 text-sm text-gray-700">{{ $submission->assignment->title }}</td>
                            <td class="py-4 px-6 text-sm text-gray-700">{{ $submission->student->name }}</td>
                            <td class="py-4 px-6 text-sm text-blue-600">
                                <a href="{{ route('submissions.file', basename($submission->file_path)) }}" target="_blank" class="hover:underline">View File</a>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <form method="POST" action="#" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 px-6 text-center text-gray-500">No submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $submissions->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
