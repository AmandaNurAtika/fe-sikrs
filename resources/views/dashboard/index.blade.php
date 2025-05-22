@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kelas Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 mr-4">
                    <i class="fas fa-chalkboard text-blue-500 text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase">Total Kelas</p>
                    <p class="text-2xl font-bold text-gray-700">{{ $kelasCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('kelas.index') }}" class="text-blue-500 hover:text-blue-700 font-medium">
                    Lihat semua kelas <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Prodi Card -->
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 mr-4">
                    <i class="fas fa-graduation-cap text-green-500 text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 uppercase">Total Program Studi</p>
                    <p class="text-2xl font-bold text-gray-700">{{ $prodiCount }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('prodi.index') }}" class="text-green-500 hover:text-green-700 font-medium">
                    Lihat semua program studi <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    
</div>
@endsection
