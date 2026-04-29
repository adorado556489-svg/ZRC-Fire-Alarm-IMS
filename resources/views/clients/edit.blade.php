@extends('layouts.app')
@section('title', 'Edit Client')
@section('content')
<div class="mb-3"><a href="{{ route('clients.index') }}" class="text-muted text-decoration-none" style="font-size:13px;"><i class="bi bi-arrow-left me-1"></i>Back to Clients</a></div>
<div class="page-title">Edit Client</div>
<div class="page-subtitle">Update client information</div>
<div class="card" style="max-width:640px;">
    <div class="card-body p-4">
        <form action="{{ route('clients.update', $client) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="client_fname" class="form-control @error('client_fname') is-invalid @enderror" value="{{ old('client_fname', $client->client_fname) }}" required>
                    @error('client_fname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="client_mname" class="form-control @error('client_mname') is-invalid @enderror" value="{{ old('client_mname', $client->client_mname) }}">
                    @error('client_mname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="client_lname" class="form-control @error('client_lname') is-invalid @enderror" value="{{ old('client_lname', $client->client_lname) }}" required>
                    @error('client_lname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Contact Person <span class="text-danger">*</span></label>
                <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $client->contact_person) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address', $client->address) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}">
                </div>
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Update Client</button>
                <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
