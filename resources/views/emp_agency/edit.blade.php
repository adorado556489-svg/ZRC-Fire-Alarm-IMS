@extends('layouts.app')
@section('title', 'Edit Agency')
@section('content')
<div class="mb-3"><a href="{{ route('emp-agency.index') }}" class="text-muted text-decoration-none" style="font-size:13px;"><i class="bi bi-arrow-left me-1"></i>Back to Agencies</a></div>
<div class="page-title">Edit Agency Record</div>
<div class="page-subtitle">Update agency information</div>
<div class="card" style="max-width:660px;">
    <div class="card-body p-4">
        <form action="{{ route('emp-agency.update', $agency) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select" required>
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" {{ old('project_id', $agency->project_id) == $project->project_id ? 'selected' : '' }}>
                        {{ $project->project_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Agency Name <span class="text-danger">*</span></label>
                <input type="text" name="agency_name" class="form-control" value="{{ old('agency_name', $agency->agency_name) }}" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $agency->contact_person) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $agency->phone) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Number of Workers Deployed <span class="text-danger">*</span></label>
                <input type="number" name="workers_deployed" class="form-control" value="{{ old('workers_deployed', $agency->workers_deployed) }}" min="1" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date Start</label>
                    <input type="date" name="date_start" class="form-control" value="{{ old('date_start', $agency->date_start) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date End</label>
                    <input type="date" name="date_end" class="form-control" value="{{ old('date_end', $agency->date_end) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Task Assigned</label>
                <input type="text" name="task_assigned" class="form-control" value="{{ old('task_assigned', $agency->task_assigned) }}">
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Update Agency</button>
                <a href="{{ route('emp-agency.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
