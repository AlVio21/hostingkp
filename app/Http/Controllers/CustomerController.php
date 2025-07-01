<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $customers = Customer::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%');
        })->orderBy('name')->get();

        return view('customers.index', compact('customers', 'search'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $existingCustomer = Customer::whereRaw('LOWER(name) = ?', [strtolower($request->name)])->first();

        if ($existingCustomer) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Customer dengan nama tersebut sudah ada.');
        }

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function edit(Customer $customer)
    {
        $this->authorizeAdmin();
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $existingCustomer = Customer::whereRaw('LOWER(name) = ?', [strtolower($request->name)])
            ->where('id', '!=', $customer->id)
            ->first();

        if ($existingCustomer) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nama customer sudah digunakan oleh customer lain.');
        }

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui!');
    }

    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }
}
