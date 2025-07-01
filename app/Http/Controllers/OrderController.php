<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::with(['product', 'customer'])->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Jumlah pesanan melebihi stok produk yang tersedia.');
        }

        $totalPrice = $product->price * $request->quantity;

        $product->stock -= $request->quantity;
        $product->save();

        Order::create([
            'customer_id'     => $request->customer_id,
            'product_id'      => $request->product_id,
            'quantity'        => $request->quantity,
            'total_price'     => $totalPrice,
            'payment_method'  => $request->payment_method,
            'status'          => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil ditambahkan dan stok telah dikurangi.');
    }

    public function edit(Order $order)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $customers = Customer::all();
        $products = Product::all();

        return view('orders.edit', compact('order', 'customers', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses.');
        }

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($order->product_id != $request->product_id) {
            // Kembalikan stok produk lama
            $oldProduct = Product::find($order->product_id);
            if ($oldProduct) {
                $oldProduct->stock += $order->quantity;
                $oldProduct->save();
            }

            $newProduct = Product::findOrFail($request->product_id);
            if ($request->quantity > $newProduct->stock) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Jumlah pesanan melebihi stok produk yang tersedia.');
            }

            $newProduct->stock -= $request->quantity;
            $newProduct->save();

            $totalPrice = $newProduct->price * $request->quantity;
        } else {
 
            $product = Product::findOrFail($request->product_id);
            $difference = $request->quantity - $order->quantity;

            if ($difference > 0 && $difference > $product->stock) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Jumlah tambahan pesanan melebihi stok yang tersedia.');
            }

            $product->stock -= $difference;
            $product->save();

            $totalPrice = $product->price * $request->quantity;
        }

        $order->update([
            'customer_id'     => $request->customer_id,
            'product_id'      => $request->product_id,
            'quantity'        => $request->quantity,
            'total_price'     => $totalPrice,
            'payment_method'  => $request->payment_method,
            'status'          => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui dan stok telah disesuaikan.');
    }
}
