<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();

        return view('dashboard', compact('totalProducts', 'totalCustomers', 'totalOrders'));
    }
}
