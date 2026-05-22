@extends('layouts.app')
@section('title', 'Edit Material')
@section('content')
<div class="mb-3">
    <a href="{{ route('materials.index') }}" class="btn btn-outline-dark btn-sm">
        <i class="bi bi-arrow-left me-1"></i>Back to Materials
    </a>
</div>
<div class="page-title">Edit Material</div>
<div class="page-subtitle">Update material information</div>
<div class="card" style="max-width:620px;">
    <div class="card-body p-4">
        <form action="{{ route('materials.update', $material) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Material Name <span class="text-danger">*</span></label>
                <input type="text" name="material_name" class="form-control" value="{{ old('material_name', $material->material_name) }}" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control" value="{{ old('brand', $material->brand) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Unit <span class="text-danger">*</span></label>
                    <input type="text" name="unit" class="form-control" value="{{ old('unit', $material->unit) }}" placeholder="(eg. pcs, meters, box)" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Unit Price (&#8369;) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="unit_price" class="form-control" value="{{ old('unit_price', $material->unit_price) }}" required>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Supplier <span class="text-danger">*</span></label>
                    <select name="supplier_id" class="form-select" required>
                        <option value="">-- Select Supplier --</option>
                        @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_id }}" {{ old('supplier_id', $material->supplier_id) == $supplier->supplier_id ? 'selected' : '' }}>
                            {{ $supplier->supplier_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Update Material</button>
                <a href="{{ route('materials.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
