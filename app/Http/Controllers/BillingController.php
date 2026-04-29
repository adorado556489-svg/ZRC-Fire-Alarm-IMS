<?php
namespace App\Http\Controllers;
use App\Models\Billing;
use App\Models\Project;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with('project')->latest()->paginate(15);
        return view('billing.index', compact('billings'));
    }

    public function create()
    {
        $projects = Project::orderBy('project_name')->get();
        return view('billing.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'     => 'required|exists:projects,project_id',
            'billing_type'   => 'required|string',
            'billing_date'   => 'required|date',
            'amount_billed'  => 'required|numeric|min:0',
            'amount_paid'    => 'nullable|numeric|min:0',
            'payment_status' => 'required|string',
        ]);
        Billing::create($request->all());
        return redirect()->route('billing.index')->with('success', 'Billing record created.');
    }

    public function edit(Billing $billing)
    {
        $projects = Project::orderBy('project_name')->get();
        return view('billing.edit', compact('billing', 'projects'));
    }

    public function update(Request $request, Billing $billing)
    {
        $request->validate([
            'project_id'     => 'required|exists:projects,project_id',
            'billing_type'   => 'required|string',
            'billing_date'   => 'required|date',
            'amount_billed'  => 'required|numeric|min:0',
            'amount_paid'    => 'nullable|numeric|min:0',
            'payment_status' => 'required|string',
        ]);
        $billing->update($request->all());
        return redirect()->route('billing.index')->with('success', 'Billing record updated.');
    }

    public function destroy(Billing $billing)
    {
        $billing->delete();
        return redirect()->route('billing.index')->with('success', 'Billing record deleted.');
    }
}
