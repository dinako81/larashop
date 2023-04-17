<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FundsController extends Controller
{
    public function addfunds(Client $client)
    {
        return view('funds.addfunds', [
            'client' => $client
        ]);
    }

    public function plusfunds(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }  $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        } 

        $client->acc_balance = $request->acc_balance+ $client->acc_balance;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'Your amount has increaseds!');
    }

    public function withdrawfunds(Client $client)
    {
        return view('funds.withdrawfunds', [
            'client' => $client
        ]);
    }

    public function minusfunds(Request $request, Client $client)

    {        
        $validator = Validator::make($request->all(), [
            'acc_balance' => 'required|numeric|min:0',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }  
        if ($request->acc_balance > $client->acc_balance) {
            return redirect()
            ->route('clients-index')
            ->with('warn', 'There are insufficient funds in the account!');
    
        } 
        $client->acc_balance =  $client->acc_balance - $request->acc_balance;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'Your amount has decreased!');
    
    }
}