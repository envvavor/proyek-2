<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Tugas') }}
        </h2>
    </x-slot>
    <div class="mt-6">
        @if(isset($assignments) && $assignments->count() > 0)
            <div class="space-y-6">
                @foreach ($assignments as $assignment)
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">Mata Pelajaran : {{ $assignment->subject->name }}</h3>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $assignment->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $assignment->description }}</p>
                        <p class="text-gray-600 mb-4">Batas Waktu : <strong>{{ $assignment->due_date }}</strong></p>

                        @if ($assignment->submissions->isNotEmpty())
                            <p class="text-green-500 font-semibold"><strong>Status:</strong> Sudah dikumpulkan</p>
                        @else
                            <form action="{{ route('submissions.store', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <input type="file" name="file" class="border border-gray-300 rounded-lg p-2 w-full mb-2" required>
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Kumpulkan</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-600">Tidak ada tugas untuk kelas ini.</p>
        @endif
    </div>
</x-app-layout>
