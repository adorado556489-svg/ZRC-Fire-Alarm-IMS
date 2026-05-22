@extends('layouts.app')
@section('title', 'Add Project')
@section('content')
<div class="mb-3"><a href="{{ route('projects.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Projects</a></div>
<div class="page-title">Create Project from Approved Quotation</div>
<div class="page-subtitle">Execution starts only after quotation approval</div>
<div class="card" style="max-width:780px;">
    <div class="card-body p-4">
        @if($quotations->isEmpty())
            <div class="alert alert-warning mb-0">
                No approved quotations are available for project creation yet.
                <a href="{{ route('quotations.create') }}" class="alert-link">Create a quotation first.</a>
            </div>
        @else
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <h6 class="text-muted mb-3" style="font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Source Quotation</h6>
            <div class="mb-3">
                <label class="form-label">Approved Quotation <span class="text-danger">*</span></label>
                <select name="quotation_id" class="form-select @error('quotation_id') is-invalid @enderror" required>
                    <option value="">-- Select Approved Quotation --</option>
                    @foreach($quotations as $quotation)
                    <option value="{{ $quotation->quotation_id }}" {{ old('quotation_id', optional($selectedQuotation)->quotation_id) == $quotation->quotation_id ? 'selected' : '' }}>
                        {{ $quotation->subject }} - {{ $quotation->client->client_name ?? 'Unknown Client' }} (₱{{ number_format($quotation->amount, 2) }})
                    </option>
                    @endforeach
                </select>
                @error('quotation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <h6 class="text-muted mb-3" style="font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Project Info</h6>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Project Name <span class="text-danger">*</span></label>
                    <input type="text" name="project_name" class="form-control @error('project_name') is-invalid @enderror" value="{{ old('project_name') }}" required>
                    @error('project_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contract Price (₱) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="contract_price" class="form-control @error('contract_price') is-invalid @enderror" value="{{ old('contract_price') }}" required>
                    @error('contract_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        @foreach(['Approved','Ongoing','Completed','Cancelled'] as $s)
                        <option value="{{ $s }}" {{ old('status','Approved') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                </div>
            </div>
            <hr class="my-3">
            <h6 class="text-muted mb-3" style="font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Testing & Commissioning</h6>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Initial Test Date</label>
                    <input type="date" name="initial_test_date" class="form-control" value="{{ old('initial_test_date') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Final Test Date</label>
                    <input type="date" name="final_test_date" class="form-control" value="{{ old('final_test_date') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Test Result</label>
                    <select name="test_result" class="form-select">
                        <option value="">-- None --</option>
                        @foreach(['Passed','Failed','Pending'] as $s)
                        <option value="{{ $s }}" {{ old('test_result') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Conducted By</label>
                <input type="text" name="tc_conducted_by" class="form-control" value="{{ old('tc_conducted_by') }}">
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Save Project</button>
                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
