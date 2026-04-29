@extends('layouts.app')
@section('title', 'Materials')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div><div class="page-title">Materials</div><div class="page-subtitle">Fire alarm materials and equipment catalog</div></div>
    <a href="{{ route('materials.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Add Material</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Material Name</th>
                    <th>Brand</th>
                    <th>Unit</th>
                    <th>Unit Price</th>
                    <th>Supplier</th>
                    <th class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materials as $material)
                <tr>
                    <td class="ps-3"><strong>{{ $material->material_name }}</strong></td>
                    <td>{{ $material->brand ?? '—' }}</td>
                    <td>{{ $material->unit }}</td>
                    <td>&#8369;{{ number_format($material->unit_price, 2) }}</td>
                    <td>{{ $material->supplier->supplier_name ?? '—' }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('materials.edit', $material) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('materials.destroy', $material) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this material?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No materials yet. <a href="{{ route('materials.create') }}">Add one now.</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($materials->hasPages())
    <div class="card-footer bg-white">{{ $materials->links() }}</div>
    @endif
</div>
@endsection
