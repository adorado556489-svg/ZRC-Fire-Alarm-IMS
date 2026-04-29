@extends('layouts.app')
@section('title', 'Edit Project Material')
@section('content')
<div class="mb-3"><a href="{{ route('project-materials.index') }}" class="text-muted text-decoration-none" style="font-size:13px;"><i class="bi bi-arrow-left me-1"></i>Back to Project Materials</a></div>
<div class="page-title">Edit Project Material</div>
<div class="page-subtitle">Update material assignment</div>
<div class="card" style="max-width:640px;">
    <div class="card-body p-4">
        <form action="{{ route('project-materials.update', $projectMaterial) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select" required>
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" {{ old('project_id', $projectMaterial->project_id) == $project->project_id ? 'selected' : '' }}>
                        {{ $project->project_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Material <span class="text-danger">*</span></label>
                <select name="material_id" class="form-select" required id="materialSelect">
                    <option value="">-- Select Material --</option>
                    @foreach($materials as $material)
                    <option value="{{ $material->material_id }}"
                        data-price="{{ $material->unit_price }}"
                        {{ old('material_id', $projectMaterial->material_id) == $material->material_id ? 'selected' : '' }}>
                        {{ $material->material_name }} (&#8369;{{ number_format($material->unit_price,2) }}/{{ $material->unit }})
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $projectMaterial->quantity) }}" min="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Cost (&#8369;)</label>
                    <input type="number" step="0.01" name="total_cost" id="total_cost" class="form-control" value="{{ old('total_cost', $projectMaterial->total_cost) }}" readonly style="background:#f8f9fa;">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Delivery Date</label>
                    <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date', $projectMaterial->delivery_date) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Delivery Status</label>
                    <select name="delivery_status" class="form-select">
                        @foreach(['Pending','Delivered','Partial'] as $s)
                        <option value="{{ $s }}" {{ old('delivery_status', $projectMaterial->delivery_status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Update</button>
                <a href="{{ route('project-materials.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<script>
function computeCost() {
    const sel = document.getElementById('materialSelect');
    const qty = document.getElementById('quantity').value;
    const opt = sel.options[sel.selectedIndex];
    const price = opt ? parseFloat(opt.dataset.price) || 0 : 0;
    document.getElementById('total_cost').value = (price * (qty || 0)).toFixed(2);
}
document.getElementById('materialSelect').addEventListener('change', computeCost);
document.getElementById('quantity').addEventListener('input', computeCost);
</script>
@endsection
