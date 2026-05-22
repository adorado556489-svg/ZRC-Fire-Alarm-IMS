@extends('layouts.app')
@section('title', 'Add Supplier')
@section('content')
<div class="mb-3"><a href="{{ route('suppliers.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Suppliers</a></div>
<div class="page-title">Add Supplier</div><div class="page-subtitle">Register a new material supplier</div>
<div class="card" style="max-width:600px;"><div class="card-body p-4">
    <form action="{{ route('suppliers.store') }}" method="POST">@csrf
        <div class="mb-3"><label class="form-label">Supplier Name <span class="text-danger">*</span></label>
            <input type="text" name="supplier_name" class="form-control @error('supplier_name') is-invalid @enderror" value="{{ old('supplier_name') }}" required>
            @error('supplier_name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
        <div class="mb-3"><label class="form-label">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person') }}"></div>
        <div class="row">
            <div class="col-md-6 mb-3"><label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"></div>
            <div class="col-md-6 mb-3"><label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}"></div>
        </div>
        <div class="mb-3"><label class="form-label">Address</label>
            <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea></div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Save Supplier</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div></div>
@endsection
