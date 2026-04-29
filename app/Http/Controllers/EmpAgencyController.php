<?php
namespace App\Http\Controllers;
use App\Models\EmpAgency;
use App\Models\Project;
use Illuminate\Http\Request;

class EmpAgencyController extends Controller
{
    public function index()
    {
        $agencies = EmpAgency::with('project')->latest()->paginate(15);
        return view('emp_agency.index', compact('agencies'));
    }

    public function create()
    {
        $projects = Project::orderBy('project_name')->get();
        return view('emp_agency.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'       => 'required|exists:projects,project_id',
            'agency_name'      => 'required|string|max:150',
            'workers_deployed' => 'required|integer|min:1',
        ]);
        EmpAgency::create($request->all());
        return redirect()->route('emp-agency.index')->with('success', 'Agency record added successfully.');
    }

    public function edit(EmpAgency $agency)
    {
        $projects = Project::orderBy('project_name')->get();
        return view('emp_agency.edit', compact('agency', 'projects'));
    }

    public function update(Request $request, EmpAgency $agency)
    {
        $request->validate([
            'project_id'       => 'required|exists:projects,project_id',
            'agency_name'      => 'required|string|max:150',
            'workers_deployed' => 'required|integer|min:1',
        ]);
        $agency->update($request->all());
        return redirect()->route('emp-agency.index')->with('success', 'Agency record updated.');
    }

    public function destroy(EmpAgency $agency)
    {
        $agency->delete();
        return redirect()->route('emp-agency.index')->with('success', 'Agency record deleted.');
    }
}
