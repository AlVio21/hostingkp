@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Products -->
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Products</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $totalProducts }}</p>
        </div>

        <!-- Total Customers -->
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Customers</h3>
            <p class="text-3xl font-bold text-green-600">{{ $totalCustomers }}</p>
        </div>

        <!-- Total Orders -->
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Orders</h3>
            <p class="text-3xl font-bold text-red-600">{{ $totalOrders }}</p>
        </div>
    </div>
@endsection
