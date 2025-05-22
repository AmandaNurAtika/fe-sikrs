@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('kelas.index') }}" class="text-blue-500 hover:text-blue-700 mr-2">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Kelas Baru</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="nama_kelas" class="block text-gray-700 text-sm font-bold mb-2">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_kelas') border-red-500 @enderror" value="{{ old('nama_kelas') }}" required maxlength="10">
                @error('nama_kelas')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-xs italic mt-1">ID Kelas akan dibuat otomatis</p>
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
