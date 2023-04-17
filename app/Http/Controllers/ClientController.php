<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $clients = Client::all()->sortByDesc('name');
        $clients = Client::orderBy('name', 'desc')->get();

        
        // $sort = $request->sort ?? '';
        // $per = (int) ($request->per ?? 10);
        // $page = $request->page ?? 1;

        // $clients = match($sort) {
        //     'name_asc' => $clients->orderBy('name'),
        //     'name_desc' => $clients->orderBy('name', 'desc'),
        //     'surname_asc' => $clients->orderBy('surname'),
        //     'surname_desc' => $clients->orderBy('surname', 'desc')
        // };

        // $request->session()->put('last-client-view', [
        //     'sort' => $sort,
        //     'page' => $page,
        //     'per' => $per
        // ]);

        // $clients = $clients->paginate($per)->withQueryString();


        return view('clients.index', [
            'clients' => $clients
            // 'sortSelect' => Client::SORT,
            // 'sort' => $sort,
            // 'perSelect' => Client::PER,
            // 'per' => $per,
            // 'page' => $page
        ]);

    }

    public function create()
    {
        $acc_number = 'LT' . rand(0, 9) . rand(0, 9) . ' ' . '0014' . ' ' . '7' . rand(0, 9) . rand(0, 9) . rand(0, 9) . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9)  . ' ' . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        return view ('clients.create', [
            'acc_number' => $acc_number
        ]);
    }

    public function store(Request $request, Client $client)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|alpha',
            'surname' => 'required|min:3|alpha',
            'personal_code' => 'required|min:11|numeric',
        ]); 
        
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);

        } if ($client->personal_code = $request->personal_code) {
            return redirect()
            ->route('clients-index')
            ->with('warn', 'The personal code exist!');
    
        }
        
        $client = new Client;
        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->personal_code = $request->personal_code;
        $client->acc_number = $request->acc_number;
        $client->acc_balance = $request->acc_balance;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'New client was created');
        
    }

    public function show(Client $client)
    {
        return view('clients.show', [
            'client' => $client
        ]);
    }

    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|alpha',
            'surname' => 'required|min:3|alpha',
            'personal_code' => 'required|min:11|numeric',
        ]);

        // p_c regex validation
 
        if ($validator->fails()) {
            $request->flash();
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }

        $client->name = $request->name;
        $client->surname = $request->surname;
        $client->personal_code = $request->personal_code;
        $client->save();
        return redirect()
        ->route('clients-index')
        ->with('ok', 'This client was updated!');
    }

    public function destroy(Client $client)
    {
        if ($client->acc_balance > 0) {
            return redirect()
            ->route('clients-index')
            ->with('warn', 'The client has funds in the account!');
    
        } else {

        $client->delete();
        return redirect()
        ->route('clients-index')
        ->with('info', 'Teh client was deleted!');
        }

    }
}