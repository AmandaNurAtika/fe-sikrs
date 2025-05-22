<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademik Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col flex-grow pt-5 overflow-y-auto bg-indigo-700 border-r">
                    <div class="flex flex-col items-center flex-shrink-0 px-4">
                        <a href="{{ route('dashboard') }}" class="px-8 text-left focus:outline-none">
                            <h2 class="block p-2 text-xl font-medium tracking-tighter text-white transition duration-500 ease-in-out transform cursor-pointer">Akademik Dashboard</h2>
                        </a>
                    </div>
                    <div class="flex flex-col flex-grow px-4 mt-5">
                        <nav class="flex-1 space-y-1 bg-indigo-700">
                            <ul>
                                <li>
                                    <a href="{{ route('dashboard') }}" class="inline-flex items-center w-full px-4 py-2 mt-1 text-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-indigo-800">
                                        <i class="fas fa-home mr-3"></i>
                                        <span class="ml-2">Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('kelas.index') }}" class="inline-flex items-center w-full px-4 py-2 mt-1 text-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-indigo-800">
                                        <i class="fas fa-chalkboard mr-3"></i>
                                        <span class="ml-2">Kelas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('prodi.index') }}" class="inline-flex items-center w-full px-4 py-2 mt-1 text-white transition duration-200 ease-in-out transform rounded-lg focus:shadow-outline hover:bg-indigo-800">
                                        <i class="fas fa-graduation-cap mr-3"></i>
                                        <span class="ml-2">Program Studi</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <main class="relative flex-1 overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
                        @if(session('success'))
                            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </main>
        
        <!-- Debug Information (Only in Development) -->
        @if(config('app.debug') && session('debug'))
        <div class="bg-gray-800 text-white p-4 text-xs hidden">
            <h3 class="font-bold mb-2">Debug Information:</h3>
            <div class="overflow-x-auto">
                <pre>{{ print_r(session('debug'), true) }}</pre>
            </div>
        </div>
        @endif
        </div>
    </div>

    <!-- Mobile menu button -->
    <div class="md:hidden fixed bottom-4 right-4">
        <button id="mobile-menu-button" class="p-3 bg-indigo-600 rounded-full text-white shadow-lg">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50">
        <div class="fixed inset-y-0 left-0 w-64 bg-indigo-700 p-5">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-medium text-white">Akademik Dashboard</h2>
                <button id="close-menu" class="text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav>
                <ul>
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-white hover:bg-indigo-800 rounded-lg">
                            <i class="fas fa-home mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('kelas.index') }}" class="block px-4 py-2 text-white hover:bg-indigo-800 rounded-lg">
                            <i class="fas fa-chalkboard mr-3"></i> Kelas
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('prodi.index') }}" class="block px-4 py-2 text-white hover:bg-indigo-800 rounded-lg">
                            <i class="fas fa-graduation-cap mr-3"></i> Program Studi
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.remove('hidden');
        });

        document.getElementById('close-menu').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.add('hidden');
        });

        // Close menu when clicking outside
        document.getElementById('mobile-menu').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
