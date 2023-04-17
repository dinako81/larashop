<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   
    public function index()
    {
        //
    }

   
    public function create()

    {

        $clients = Client::all();
        return view('orders.create', [
            'clients' => $clients
        ]);
    }

   
    public function store(Request $request)
    {
        Order::create([
            'title' => $request->title,
            'price' => $request->price,
            'client_id' => $request->client_id,

        ]);
    }

    
    public function show(Order $order)
    {
        //
    }

    
    public function edit(Order $order)
    {
        //
    }

    
    public function update(Request $request, Order $order)
    {
        //
    }

    
    public function destroy(Order $order)
    {
        //
    }
}