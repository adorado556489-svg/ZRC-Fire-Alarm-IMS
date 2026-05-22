@extends('layouts.app')
@section('title', 'Edit Project')
@section('content')
<div class="mb-3"><a href="{{ route('projects.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Projects</a></div>
<div class="page-title">Edit Project</div>
<div class="page-subtitle">Update project information</div>
<div class="card" style="max-width:780px;">
    <div class="card-body p-4">
        <form action="{{ route('projects.update', $project) }}" method="POST">
            @csrf @method('PUT')
            @if($project->quotation)
            <div class="alert alert-light border mb-3">
                <div class="small text-muted mb-1">Source Quotation</div>
                <strong>{{ $project->quotation->subject }}</strong>
                <div class="small text-muted">{{ $project->quotation->client->client_name ?? 'Unknown Client' }} | ₱{{ number_format($project->quotation->amount, 2) }}</div>
            </div>
            @endif
            <h6 class="text-muted mb-3" style="font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Project Info</h6>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Project Name <span class="text-danger">*</span></label>
                    <input type="text" name="project_name" class="form-control" value="{{ old('project_name', $project->project_name) }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $project->location) }}">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contract Price (₱) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="contract_price" class="form-control" value="{{ old('contract_price', $project->contract_price) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        @foreach(['Bidding','Approved','Ongoing','Completed','Cancelled'] as $s)
                        <option value="{{ $s }}" {{ old('status', $project->status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $project->start_date) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $project->end_date) }}">
                </div>
            </div>
            <hr class="my-3">
            <h6 class="text-muted mb-3" style="font-size:12px;text-transform:uppercase;letter-spacing:.05em;">Testing & Commissioning</h6>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Initial Test Date</label>
                    <input type="date" name="initial_test_date" class="form-control" value="{{ old('initial_test_date', $project->initial_test_date) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Final Test Date</label>
                    <input type="date" name="final_test_date" class="form-control" value="{{ old('final_test_date', $project->final_test_date) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Test Result</label>
                    <select name="test_result" class="form-select">
                        <option value="">-- None --</option>
                        @foreach(['Passed','Failed','Pending'] as $s)
                        <option value="{{ $s }}" {{ old('test_result', $project->test_result) == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Conducted By</label>
                <input type="text" name="tc_conducted_by" class="form-control" value="{{ old('tc_conducted_by', $project->tc_conducted_by) }}">
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Update Project</button>
                <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
