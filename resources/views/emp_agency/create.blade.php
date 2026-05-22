@extends('layouts.app')
@section('title', 'Add Agency')
@section('content')
<div class="mb-3"><a href="{{ route('emp-agency.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Agencies</a></div>
<div class="page-title">Add Employment Agency</div>
<div class="page-subtitle">Record a contractual manpower agency for a project</div>
<div class="card" style="max-width:660px;">
    <div class="card-body p-4">
        <form action="{{ route('emp-agency.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" {{ old('project_id') == $project->project_id ? 'selected' : '' }}>
                        {{ $project->project_name }}
                    </option>
                    @endforeach
                </select>
                @error('project_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Agency Name <span class="text-danger">*</span></label>
                <input type="text" name="agency_name" class="form-control @error('agency_name') is-invalid @enderror" value="{{ old('agency_name') }}" required>
                @error('agency_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Number of Workers Deployed <span class="text-danger">*</span></label>
                <input type="number" name="workers_deployed" class="form-control @error('workers_deployed') is-invalid @enderror" value="{{ old('workers_deployed') }}" min="1" required>
                @error('workers_deployed')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date Start</label>
                    <input type="date" name="date_start" class="form-control" value="{{ old('date_start') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date End</label>
                    <input type="date" name="date_end" class="form-control" value="{{ old('date_end') }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Task Assigned</label>
                <input type="text" name="task_assigned" class="form-control" value="{{ old('task_assigned') }}" placeholder="e.g. Fire alarm installation">
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Save Agency</button>
                <a href="{{ route('emp-agency.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
