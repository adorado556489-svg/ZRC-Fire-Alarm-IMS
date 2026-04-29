<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Quotation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with(['client', 'project'])->latest()->paginate(15);
        return view('quotations.index', compact('quotations'));
    }

    public function create()
    {
        $clients = Client::orderBy('client_name')->get();
        return view('quotations.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'subject' => 'required|string|max:200',
            'quotation_date' => 'required|date',
            'followup_date' => 'nullable|date|after_or_equal:quotation_date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Approved,Rejected',
            'remarks' => 'nullable|string',
        ]);

        if (empty($validated['followup_date'])) {
            $validated['followup_date'] = Carbon::parse($validated['quotation_date'])->addDays(10)->toDateString();
        }

        Quotation::create($validated);

        return redirect()->route('quotations.index')->with('success', 'Quotation created successfully.');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load(['client', 'project']);
        return view('quotations.show', compact('quotation'));
    }

    public function edit(Quotation $quotation)
    {
        $clients = Client::orderBy('client_name')->get();
        return view('quotations.edit', compact('quotation', 'clients'));
    }

    public function update(Request $request, Quotation $quotation)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'subject' => 'required|string|max:200',
            'quotation_date' => 'required|date',
            'followup_date' => 'nullable|date|after_or_equal:quotation_date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Approved,Rejected',
            'remarks' => 'nullable|string',
        ]);

        if (empty($validated['followup_date'])) {
            $validated['followup_date'] = Carbon::parse($validated['quotation_date'])->addDays(10)->toDateString();
        }

        $quotation->update($validated);

        return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully.');
    }

    public function destroy(Quotation $quotation)
    {
        if ($quotation->project) {
            return redirect()->route('quotations.index')->with('error', 'Quotation already converted to project and cannot be deleted.');
        }

        $quotation->delete();
        return redirect()->route('quotations.index')->with('success', 'Quotation deleted.');
    }

    public function createProject(Quotation $quotation)
    {
        if ($quotation->status !== 'Approved') {
            return redirect()->route('quotations.index')->with('error', 'Only approved quotations can be converted into projects.');
        }

        if ($quotation->project) {
            return redirect()->route('projects.edit', $quotation->project)->with('error', 'This quotation is already linked to a project.');
        }

        return redirect()->route('projects.create', ['quotation_id' => $quotation->quotation_id]);
    }
}
