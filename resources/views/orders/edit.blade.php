@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Order</h2>
            <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:underline">← Kembali</a>
        </div>

        <form action="{{ route('orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Customer</label>
                <select name="customer_id" class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Produk</label>
                <select name="product_id" class="w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jumlah</label>
                <input type="number" name="quantity" value="{{ $order->quantity }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Metode Pembayaran</label>
                <select name="payment_method" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="cash" {{ $order->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="transfer" {{ $order->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Status</label>
                <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update Order
            </button>
        </form>
    </div>
</div>
@endsection
