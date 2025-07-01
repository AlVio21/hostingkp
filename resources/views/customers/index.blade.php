@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-6">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-2xl font-semibold text-white bg-blue-600 px-4 py-2 rounded-md shadow mb-6">
        Daftar Customer
    </h1>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 space-y-3 md:space-y-0">
        <form method="GET" action="{{ route('customers.index') }}" class="flex w-full md:w-auto items-center space-x-2">
            <div class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari customer..." class="w-full md:w-64 px-4 py-2 rounded-l-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 rounded-r-md">
                    Cari
                </button>
            </div>
            @if(request('search'))
            <a href="{{ route('customers.index') }}"
               class="text-sm text-red-600 hover:underline whitespace-nowrap ml-2">
                Reset
            </a>
            @endif
        </form>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('customers.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded shadow transition">
            + Tambah Customer
        </a>
        @endif
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-center">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Telepon</th>
                    <th class="px-4 py-2">Alamat</th>
                    @if(auth()->user()->role === 'admin')
                        <th class="px-4 py-2">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($customers as $customer)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $customer->name }}</td>
                    <td class="px-4 py-2">{{ $customer->phone }}</td>
                    <td class="px-4 py-2">{{ $customer->address }}</td>
                    @if(auth()->user()->role === 'admin')
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('customers.edit', $customer) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            Edit
                        </a>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-4 text-gray-500 italic">Belum ada customer.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
