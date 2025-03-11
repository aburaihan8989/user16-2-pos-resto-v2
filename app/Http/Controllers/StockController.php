<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index(Request $request)
    {
        //get data products
        $products = DB::table('stocks')
            ->when($request->input('transaction_time'), function ($query, $transaction_time) {
                return $query->where('transaction_time', 'like', '%' . $transaction_time . '%');
            })
            ->select('products.name as nama','stocks.transaction_time','stocks.total_price','stocks.quantity','users.name')
            ->leftJoin('products', 'stocks.product_id', '=', 'products.id')
            ->leftJoin('users', 'stocks.user_id', '=', 'users.id')
            ->where('type',0)
            ->orderBy('stocks.created_at', 'desc')
            ->paginate(10);
        //sort by created_at desc

        return view('pages.stock.index', compact('products'));
    }

    public function create()
    {
        return view('pages.stock.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $product = \App\Models\Product::where('id',$data['product_id'])->first();
        $data['total_price'] = $product->cost_price * $data['quantity'];
        $data['type'] = 0;
        $data['user_id'] = auth()->user()->id;
        \App\Models\Stock::create($data);
        $product->stock = $product->stock + $data['quantity'];
        $product->save();

        return redirect()->route('stock.index')->with('success', 'User successfully created');
    }

    public function index2(Request $request)
    {
        //get data products
        $products = DB::table('stocks')
            ->when($request->input('transaction_time'), function ($query, $transaction_time) {
                return $query->where('transaction_time', 'like', '%' . $transaction_time . '%');
            })
            ->select('products.name as nama','stocks.transaction_time','stocks.total_price','stocks.quantity','users.name','stocks.id as stock_id')
            ->leftJoin('products', 'stocks.product_id', '=', 'products.id')
            ->leftJoin('users', 'stocks.kasir_id', '=', 'users.id')
            ->where('type',1)
            ->orderBy('stocks.created_at', 'desc')
            ->paginate(10);
        //sort by created_at desc

        return view('pages.stock.index2', compact('products'));
    }

    public function create2()
    {
        return view('pages.stock.create2');
    }

    public function store2(Request $request)
    {
        $data = $request->all();
        $product = \App\Models\Product::where('id',$data['product_id'])->first();
        $data['total_price'] = $product->cost_price * $data['quantity'];
        $data['type'] = 1;
        $data['user_id'] = auth()->user()->id;
        \App\Models\Stock::create($data);
        $product->stock = $product->stock - $data['quantity'];
        $product->save();

        return redirect()->route('stock-out')->with('success', 'User successfully created');
    }

    public function show($id)
    {
        // //get order items by order id
        // $orderItems = \App\Models\OrderItem::with('product')->where('order_id', $id)->get();
        // $orderSum = \App\Models\OrderItem::where('order_id', $id)->select(DB::raw('SUM(quantity * total_price) as total'))->value('total');

        // return view('pages.orders.view', compact('order', 'kasir', 'orderItems', 'orderSum'));

        $stock = \App\Models\Stock::where('id', $id)->first();
        $product = \App\Models\Product::where('id', $stock->product_id)->first();
        $user = \App\Models\User::where('id', $stock->user_id)->first();
        $kasir = \App\Models\User::where('id', $stock->kasir_id)->first();

        return view('pages.stock.view', compact('stock', 'product', 'user', 'kasir'));
    }

    public function edit()
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
