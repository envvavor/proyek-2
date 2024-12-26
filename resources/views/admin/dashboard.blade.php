<x-app-layout>
    <div class="flex flex-col md:flex-row h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-white shadow-lg">
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-700">Admin Panel</h2>
            </div>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('users.index') }}" 
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm0 2c-4.418 0-8 3.582-8 8h16c0-4.418-3.582-8-8-8z" />
                            </svg>
                            Manage Users
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('users.create') }}" 
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                            </svg>
                            Create User
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('submissions.indexAll') }}" 
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8m-3 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2v6" />
                            </svg>
                            Manage Submissions
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('assignments.index') }}" 
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8m-3 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2v6" />
                            </svg>
                            Manage Assignments
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('subjects.index') }}" 
                        class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-600 rounded-lg transition duration-200 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8m-3 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2v6" />
                            </svg>
                            Manage Subjects
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 md:p-6 bg-gray-100 space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="font-semibold text-xl">Welcome to the Admin dashboard</h3>
                <h1 class="font-semibold text-4xl mb-4"><strong>{{ auth()->user()->name }}</strong></h1>
            </div>
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="bg-white shadow rounded-lg p-4 border-l-4 border-blue-500 w-full md:w-1/3 flex items-center">
                <div class="flex-1">
                    <h3 class="font-semibold text-l">User Statistics</h3>
                    <p class="text-gray-700 text-m">Total Users:</p>
                    <h1 class="text-xl font-semibold text-blue-500"><strong>{{ $userCount }}</strong></h1>
                </div>
                <svg class="w-10 h-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
                </div>
                <div class="bg-white shadow rounded-lg p-4 border-l-4 border-red-500 w-full md:w-1/3 flex items-center">
                <div class="flex-1">
                    <h3 class="font-semibold text-l">Assignments Statistics</h3>
                    <p class="text-gray-700 text-m">Total Assignments:</p>
                    <h1 class="text-xl font-semibold text-red-500"><strong>{{ $assignmentCount }}</strong></h1>
                </div>
                <svg class="w-10 h-10 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8m-3 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2v6" />
                </svg>
                </div>
                <div class="bg-white shadow rounded-lg p-4 border-l-4 border-yellow-500 w-full md:w-1/3 flex items-center">
                <div class="flex-1">
                    <h3 class="font-semibold text-l">Submissions Statistics</h3>
                    <p class="text-gray-700 text-m">Total Submissions:</p>
                    <h1 class="text-xl font-semibold text-yellow-500"><strong>{{ $submissionCount }}</strong></h1>
                </div>
                <svg class="w-10 h-10 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h8m-3 8H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2v6" />
                </svg>
                </div>
            </div>

            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-center py-12 bg-white shadow rounded-lg p-6">
                    <img src="{{ asset('img/undraw_add-tasks_4qsy.png') }}" alt="No Assignments" class="w-2/3 md:w-1/3 mb-6 md:mb-0 md:mr-6">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-2 text-center md:text-left">
                        Use the navigation menu to manage data effectively.
                    </h2>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
