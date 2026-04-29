@extends('layouts.app')
@section('title', 'Add Client')
@section('content')
<div class="mb-3"><a href="{{ route('clients.index') }}" class="text-muted text-decoration-none" style="font-size:13px;"><i class="bi bi-arrow-left me-1"></i>Back to Clients</a></div>
<div class="page-title">Add New Client</div>
<div class="page-subtitle">Fill in the client details below</div>
<div class="card" style="max-width:640px;">
    <div class="card-body p-4">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="client_fname" class="form-control @error('client_fname') is-invalid @enderror" value="{{ old('client_fname') }}" required>
                    @error('client_fname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="client_mname" class="form-control @error('client_mname') is-invalid @enderror" value="{{ old('client_mname') }}">
                    @error('client_mname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="client_lname" class="form-control @error('client_lname') is-invalid @enderror" value="{{ old('client_lname') }}" required>
                    @error('client_lname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Person <span class="text-danger">*</span></label>
                <input type="text" name="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{ old('contact_person') }}" required>
                @error('contact_person')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Save Client</button>
                <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
