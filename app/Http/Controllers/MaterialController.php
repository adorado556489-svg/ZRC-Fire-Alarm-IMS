<?php
namespace App\Http\Controllers;
use App\Models\Material;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with('supplier')->latest()->paginate(15);
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        return view('materials.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_name' => 'required|string|max:150',
            'unit'          => 'required|string|max:20',
            'unit_price'    => 'required|numeric|min:0',
            'supplier_id'   => 'required|exists:suppliers,supplier_id',
        ]);
        Material::create($request->all());
        return redirect()->route('materials.index')->with('success', 'Material added successfully.');
    }

    public function edit(Material $material)
    {
        $suppliers = Supplier::orderBy('supplier_name')->get();
        return view('materials.edit', compact('material', 'suppliers'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'material_name' => 'required|string|max:150',
            'unit'          => 'required|string|max:20',
            'unit_price'    => 'required|numeric|min:0',
            'supplier_id'   => 'required|exists:suppliers,supplier_id',
        ]);
        $material->update($request->all());
        return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Material deleted.');
    }
}
