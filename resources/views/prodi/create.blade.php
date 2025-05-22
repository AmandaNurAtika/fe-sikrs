@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('prodi.index') }}" class="text-green-500 hover:text-green-700 mr-2">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Program Studi Baru</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('prodi.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="kode_prodi" class="block text-gray-700 text-sm font-bold mb-2">Kode Program Studi</label>
                <input type="text" name="kode_prodi" id="kode_prodi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kode_prodi') border-red-500 @enderror" value="{{ old('kode_prodi') }}" required maxlength="8">
                @error('kode_prodi')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="nama_prodi" class="block text-gray-700 text-sm font-bold mb-2">Nama Program Studi</label>
                <input type="text" name="nama_prodi" id="nama_prodi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_prodi') border-red-500 @enderror" value="{{ old('nama_prodi') }}" required maxlength="100">
                @error('nama_prodi')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
