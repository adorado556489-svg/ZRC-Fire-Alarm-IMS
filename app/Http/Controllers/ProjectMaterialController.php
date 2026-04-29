<?php
namespace App\Http\Controllers;
use App\Models\ProjectMaterial;
use App\Models\Project;
use App\Models\Material;
use Illuminate\Http\Request;

class ProjectMaterialController extends Controller
{
    public function index()
    {
        $projectMaterials = ProjectMaterial::with('project', 'material')->latest()->paginate(15);
        return view('project_materials.index', compact('projectMaterials'));
    }

    public function create()
    {
        $projects  = Project::orderBy('project_name')->get();
        $materials = Material::with('supplier')->orderBy('material_name')->get();
        return view('project_materials.create', compact('projects', 'materials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id'  => 'required|exists:projects,project_id',
            'material_id' => 'required|exists:materials,material_id',
            'quantity'    => 'required|integer|min:1',
        ]);

        $material   = Material::findOrFail($request->material_id);
        $total_cost = $material->unit_price * $request->quantity;

        ProjectMaterial::create(array_merge($request->all(), ['total_cost' => $total_cost]));
        return redirect()->route('project-materials.index')->with('success', 'Material assigned to project successfully.');
    }

    public function edit(ProjectMaterial $projectMaterial)
    {
        $projects  = Project::orderBy('project_name')->get();
        $materials = Material::with('supplier')->orderBy('material_name')->get();
        return view('project_materials.edit', compact('projectMaterial', 'projects', 'materials'));
    }

    public function update(Request $request, ProjectMaterial $projectMaterial)
    {
        $request->validate([
            'project_id'  => 'required|exists:projects,project_id',
            'material_id' => 'required|exists:materials,material_id',
            'quantity'    => 'required|integer|min:1',
        ]);

        $material   = Material::findOrFail($request->material_id);
        $total_cost = $material->unit_price * $request->quantity;

        $projectMaterial->update(array_merge($request->all(), ['total_cost' => $total_cost]));
        return redirect()->route('project-materials.index')->with('success', 'Project material updated.');
    }

    public function destroy(ProjectMaterial $projectMaterial)
    {
        $projectMaterial->delete();
        return redirect()->route('project-materials.index')->with('success', 'Material entry removed.');
    }
}
