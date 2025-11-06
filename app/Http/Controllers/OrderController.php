<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "All Transaction";
        $datas = [];
        return view('order.index', compact('title', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $prefix = "ODR";
        $date = now()->format('dmY');
        //kalau ini yg pertama dulu.
        //1.a
        //2.b
        $lastTransaction = Order::whereDate('created_at', now()->toDateString())->orderBy('id', 'desc')->first();

        // $lastTransaction = Order::whereDate('created_at' . now()->toDateString())->get()->last(); == kalau ngk mau pake orderBy. dan ambilnya data terakhir
        //2.b
        //1.a
        $lastNumber = 0;
        if ($lastTransaction) {
            //ORD-161125-0001 = AKAN JADI =0001
            //substr motong karakter
            $lastNumber = (int) substr($lastTransaction->order_code, -4);
        }
        //str_pad menambahkan karakter ke dalam sebuah string
        $runningNumber = str_pad($lastNumber + 1, 1, '0', STR_PAD_LEFT);
        $order_code = $runningNumber . "-" . $date . "-" . $runningNumber;
        return view('order.create', compact('categories', 'order_code'));
    }



    public function getProducts()
    {
        try {
            $products = Product::with('category')->get();
            return response()->json($products);
            // return response()->json([
            //     'message' => 'Fetch Product Success',
            //     'status' => true,
            //     'data' => $products,
            // ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Fetch Product Failed',
                'status' => false,
                'data' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
