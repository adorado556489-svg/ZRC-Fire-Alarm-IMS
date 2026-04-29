@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('content')
<div class="mb-3"><a href="{{ route('suppliers.index') }}" class="text-muted text-decoration-none" style="font-size:13px;"><i class="bi bi-arrow-left me-1"></i>Back to Suppliers</a></div>
<div class="page-title">Edit Supplier</div><div class="page-subtitle">Update supplier information</div>
<div class="card" style="max-width:600px;"><div class="card-body p-4">
    <form action="{{ route('suppliers.update', $supplier) }}" method="POST">@csrf @method('PUT')
        <div class="mb-3"><label class="form-label">Supplier Name <span class="text-danger">*</span></label>
            <input type="text" name="supplier_name" class="form-control" value="{{ old('supplier_name', $supplier->supplier_name) }}" required></div>
        <div class="mb-3"><label class="form-label">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $supplier->contact_person) }}"></div>
        <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $supplier->phone) }}"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $supplier->email) }}"></div>
        </div>
        <div class="mb-3"><label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="2">{{ old('address', $supplier->address) }}</textarea></div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Update Supplier</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div></div>
@endsection
