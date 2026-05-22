<?php
namespace App\Http\Controllers;
use App\Models\Material;
use App\Models\Supplier;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('supplier_id')) {
            $request->validate([
                'supplier_id' => 'exists:suppliers,supplier_id',
            ]);
        }

        $materials = Material::query()
            ->with('supplier')
            ->when($request->filled('supplier_id'), fn ($q) => $q->where('supplier_id', $request->supplier_id))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $suppliers = Supplier::orderBy('supplier_name')->get();

        return view('materials.index', compact('materials', 'suppliers'));
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
        Material::create($request->only(['material_name', 'brand', 'unit', 'unit_price', 'supplier_id']));
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
        $material->update($request->only(['material_name', 'brand', 'unit', 'unit_price', 'supplier_id']));
        return redirect()->route('materials.index')->with('success', 'Material updated successfully.');
    }

    public function destroy($materialId)
    {
        $material = Material::find($materialId);
        if (! $material) {
            return redirect()->route('materials.index')->with('success', 'Material was already removed.');
        }

        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Material deleted.');
    }
}
