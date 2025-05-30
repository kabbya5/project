<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::where('user_id', auth()->id)->paginate(20);
        return response()->json(['clients' => $clients]);
    }

    public function stroe(Request $request){
        $client = Client::create($request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_person' => 'nullable|string|max:255'
        ]) + ['user_id' => auth()->id()]);

        return response()->json(['client' => $client]);
    }

    public function update(Request $request, Client $client){
        $client->update($request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'contact_person' => 'nullable|string|max:255'
        ]));

        return response()->json(['client' => $client]);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted.');
    }
}
