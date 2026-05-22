<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Project;
use App\Models\ProjectMaterial;
use App\Models\VwProjectDetails;
use Illuminate\Http\Request;

class ProjectMaterialController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('project_id')) {
            $request->validate([
                'project_id' => 'exists:projects,project_id',
            ]);
        }

        $projectMaterials = VwProjectDetails::query()
            ->when($request->filled('project_id'), fn ($q) => $q->where('project_id', $request->project_id))
            ->orderByDesc('proj_mat_id')
            ->paginate(15)
            ->withQueryString();

        $projects = Project::orderBy('project_name')->get();

        return view('project_materials.index', compact('projectMaterials', 'projects'));
    }

    public function create()
    {
        $projects = Project::orderBy('project_name')->get();
        $materials = Material::with('supplier')->orderBy('material_name')->get();

        return view('project_materials.create', compact('projects', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'material_id' => 'required|exists:materials,material_id',
            'quantity' => 'required|integer|min:1',
        ]);

        ProjectMaterial::create([
            'project_id' => $request->project_id,
            'material_id' => $request->material_id,
            'quantity' => (int) $request->quantity,
            'delivery_date' => $request->delivery_date,
            'delivery_status' => $request->delivery_status ?? 'Pending',
        ]);

        return redirect()->route('project-materials.index')->with('success', 'Material assigned to project successfully.');
    }

    public function edit(ProjectMaterial $projectMaterial)
    {
        $projects = Project::orderBy('project_name')->get();
        $materials = Material::with('supplier')->orderBy('material_name')->get();

        return view('project_materials.edit', compact('projectMaterial', 'projects', 'materials'));
    }

    public function update(Request $request, ProjectMaterial $projectMaterial)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,project_id',
            'material_id' => 'required|exists:materials,material_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $material = Material::query()->findOrFail($request->material_id);
        $total_cost = $material->unit_price * (int) $request->quantity;

        $projectMaterial->update(array_merge(
            $request->only(['project_id', 'material_id', 'quantity', 'delivery_date', 'delivery_status']),
            ['total_cost' => $total_cost]
        ));

        return redirect()->route('project-materials.index')->with('success', 'Project material updated.');
    }

    public function destroy(ProjectMaterial $projectMaterial)
    {
        $projectMaterial->delete();

        return redirect()->route('project-materials.index')->with('success', 'Material entry removed.');
    }
}
