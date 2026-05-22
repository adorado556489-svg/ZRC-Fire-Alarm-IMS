<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\VwProjectOverview;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('client_id')) {
            $request->validate([
                'client_id' => 'exists:clients,client_id',
            ]);
        }

        $projects = VwProjectOverview::query()
            ->when($request->filled('client_id'), function ($q) use ($request) {
                $q->whereExists(function ($sub) use ($request) {
                    $sub->from('projects')
                        ->whereColumn('projects.project_id', 'vw_project_overview.project_id')
                        ->where('projects.client_id', $request->client_id);
                });
            })
            ->orderByDesc('project_id')
            ->paginate(15)
            ->withQueryString();

        $clients = Client::query()
            ->orderBy('client_fname')
            ->orderBy('client_lname')
            ->get();

        return view('projects.index', compact('projects', 'clients'));
    }

    public function create()
    {
        $quotations = Quotation::with('client')
            ->where('status', 'Approved')
            ->whereDoesntHave('project')
            ->orderByDesc('quotation_date')
            ->get();

        $selectedQuotation = null;
        if (request()->filled('quotation_id')) {
            $selectedQuotation = $quotations->firstWhere('quotation_id', (int) request('quotation_id'));
        }

        return view('projects.create', compact('quotations', 'selectedQuotation'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quotation_id' => 'required|exists:quotations,quotation_id|unique:projects,quotation_id',
            'project_name' => 'required|string|max:200',
            'contract_price' => 'required|numeric|min:0',
            'status' => 'required|in:Approved,Ongoing,Completed,Cancelled',
            'location' => 'nullable|string|max:255',
            'downpayment' => 'nullable|numeric|min:0',
            'bid_date' => 'nullable|date',
            'approval_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'initial_test_date' => 'nullable|date',
            'final_test_date' => 'nullable|date',
            'test_result' => 'nullable|in:Passed,Failed,Pending',
            'tc_conducted_by' => 'nullable|string|max:255',
        ]);

        $quotation = Quotation::with('project')->findOrFail($validated['quotation_id']);
        if ($quotation->status !== 'Approved') {
            return back()->withInput()->withErrors([
                'quotation_id' => 'Only approved quotations can be converted to projects.',
            ]);
        }

        $validated['client_id'] = $quotation->client_id;
        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully. Initial downpayment billing is auto-created by trigger.');
    }

    public function show(Project $project)
    {
        $project->load('client', 'billing', 'quotation');

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load('quotation');

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:200',
            'contract_price' => 'required|numeric|min:0',
            'status' => 'required|in:Bidding,Approved,Ongoing,Completed,Cancelled',
            'location' => 'nullable|string|max:255',
            'downpayment' => 'nullable|numeric|min:0',
            'bid_date' => 'nullable|date',
            'approval_date' => 'nullable|date',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'initial_test_date' => 'nullable|date',
            'final_test_date' => 'nullable|date',
            'test_result' => 'nullable|in:Passed,Failed,Pending',
            'tc_conducted_by' => 'nullable|string|max:255',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted.');
    }
}
