<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Product::when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('products.index', compact('products', 'search'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('products.create');
    }

    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $existingProduct = Product::whereRaw('LOWER(name) = ?', [strtolower($request->name)])->first();

    if ($existingProduct) {
        return redirect()->back()->with('error', 'Data produk sudah ada sebelumnya.');
    }

    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'category' => $request->category,
    ]);

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit(Product $product)
    {
        $this->authorizeAdmin();
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
    $this->authorizeAdmin();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer|min:0',
        'category' => 'required|in:mobil,motor',
    ]);

    $existingProduct = Product::whereRaw('LOWER(name) = ?', [strtolower($request->name)])
        ->where('id', '!=', $product->id)
        ->first();

    if ($existingProduct) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Nama produk sudah digunakan oleh produk lain.');
    }

    $product->update($validated);

    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }


    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }
    }
}
