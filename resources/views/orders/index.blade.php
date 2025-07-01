@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    @if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md mb-6">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-2xl font-semibold text-white bg-blue-600 px-4 py-2 rounded-md shadow mb-6">
        Daftar Order
    </h1>

    <div class="flex justify-end mb-4">
        <a href="{{ route('orders.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded shadow transition">
            + Tambah Order
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-center">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Customer</th>
                    <th class="px-4 py-2">Produk</th>
                    <th class="px-4 py-2">Jumlah</th>
                    <th class="px-4 py-2">Total Harga</th>
                    <th class="px-4 py-2">Metode Pembayaran</th>
                    <th class="px-4 py-2">Status</th>
                    @if(auth()->user()->role === 'admin')
                    <th class="px-4 py-2">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $order->customer->name }}</td>
                    <td class="px-4 py-2">{{ $order->product->name }}</td>
                    <td class="px-4 py-2">{{ $order->quantity }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ ucfirst($order->payment_method) }}</td>
                    <td class="px-4 py-2">{{ ucfirst($order->status) }}</td>
                    @if(auth()->user()->role === 'admin')
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('orders.edit', $order) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            Edit
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
