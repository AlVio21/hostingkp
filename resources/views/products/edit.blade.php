@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Produk</h2>
            <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">
                ← Kembali
            </a>
        </div>
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif


        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"
                    required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Kategori</label>
                <select name="category" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="mobil" {{ $product->category == 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="motor" {{ $product->category == 'motor' ? 'selected' : '' }}>Motor</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
