@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Order</h2>
            <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
        </div>
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Customer</label>
                <select name="customer_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Produk</label>
                <select name="product_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} (Stok: {{ $product->stock }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jumlah</label>
                <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" required class="w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Metode Pembayaran</label>
                <select name="payment_method" required class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                    <option value="credit" {{ old('payment_method') == 'credit' ? 'selected' : '' }}>Credit</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Status</label>
                <select name="status" required class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan Order
            </button>
        </form>
    </div>
</div>
@endsection
