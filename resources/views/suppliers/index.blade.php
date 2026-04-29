@extends('layouts.app')
@section('title', 'Suppliers')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div><div class="page-title">Suppliers</div><div class="page-subtitle">Material suppliers and vendors</div></div>
    <a href="{{ route('suppliers.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Add Supplier</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th class="ps-3">Supplier Name</th><th>Contact Person</th><th>Phone</th><th>Email</th><th class="text-end pe-3">Actions</th></tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr>
                    <td class="ps-3"><strong>{{ $supplier->supplier_name }}</strong></td>
                    <td>{{ $supplier->contact_person ?? '—' }}</td>
                    <td>{{ $supplier->phone ?? '—' }}</td>
                    <td>{{ $supplier->email ?? '—' }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No suppliers yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
