@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('kelas.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Edit Kelas</h1>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('kelas.update', $kelas['id_kelas'] ?? '') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="id_kelas" class="block text-gray-700 text-sm font-bold mb-2">ID Kelas</label>
                <input type="number" id="id_kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100" value="{{ $kelas['id_kelas'] ?? '' }}" disabled>
                <p class="text-gray-500 text-xs italic mt-1">ID Kelas tidak dapat diubah</p>
            </div>
            
            <div class="mb-6">
                <label for="nama_kelas" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_kelas') border-red-500 @enderror" value="{{ $kelas['nama_kelas'] ?? '' }}" required maxlength="10">
                @error('nama_kelas')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update
                </button>
            </div>
        </form>
    </div>

    
</div>
@endsection
