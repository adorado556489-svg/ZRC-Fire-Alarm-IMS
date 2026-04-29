<?php
namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(15);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_fname' => 'required|string|max:100',
            'client_mname' => 'nullable|string|max:100',
            'client_lname' => 'required|string|max:100',
            'contact_person' => 'required|string|max:100',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:100',
            'address'        => 'nullable|string',
        ]);

        $validated['client_name'] = collect([
            $validated['client_fname'],
            $validated['client_mname'] ?? null,
            $validated['client_lname'],
        ])->filter()->implode(' ');

        Client::create($validated);
        return redirect()->route('clients.index')->with('success', 'Client added successfully.');
    }

    public function show(Client $client)
    {
        $client->load('projects');
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'client_fname' => 'required|string|max:100',
            'client_mname' => 'nullable|string|max:100',
            'client_lname' => 'required|string|max:100',
            'contact_person' => 'required|string|max:100',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:100',
            'address'        => 'nullable|string',
        ]);

        $validated['client_name'] = collect([
            $validated['client_fname'],
            $validated['client_mname'] ?? null,
            $validated['client_lname'],
        ])->filter()->implode(' ');

        $client->update($validated);
        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted.');
    }
}
