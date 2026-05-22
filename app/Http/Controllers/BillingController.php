<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Project;
use App\Models\VwBillingSummary;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('project_id')) {
            $request->validate([
                'project_id' => 'exists:projects,project_id',
            ]);
        }

        $billings = VwBillingSummary::query()
            ->when($request->filled('project_id'), fn ($q) => $q->where('project_id', $request->project_id))
            ->orderByDesc('billing_date')
            ->orderByDesc('billing_id')
            ->paginate(15)
            ->withQueryString();

        $projects = Project::orderBy('project_name')->get();

        return view('billing.index', compact('billings', 'projects'));
    }

    public function create()
    {
        $projects = Project::orderBy('project_name')->get();

        return view('billing.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'billing_type' => 'required|string',
            'billing_date' => 'required|date',
            'amount_billed' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
        ]);

        $validated['amount_paid'] = $validated['amount_paid'] ?? 0;
        Billing::create($validated);

        return redirect()->route('billing.index')->with('success', 'Billing record created.');
    }

    public function edit(Billing $billing)
    {
        $projects = Project::orderBy('project_name')->get();

        return view('billing.edit', compact('billing', 'projects'));
    }

    public function update(Request $request, Billing $billing)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'billing_type' => 'required|string',
            'billing_date' => 'required|date',
            'amount_billed' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
        ]);

        $validated['amount_paid'] = $validated['amount_paid'] ?? 0;
        $billing->update($validated);

        return redirect()->route('billing.index')->with('success', 'Billing record updated.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();

        return redirect()->route('billing.index')->with('success', 'Billing record deleted.');
    }
}
