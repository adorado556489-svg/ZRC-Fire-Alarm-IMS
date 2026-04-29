@extends('layouts.app')
@section('title', 'Add Billing')
@section('content')
<div class="mb-3"><a href="{{ route('billing.index') }}" class="text-muted text-decoration-none" style="font-size:13px;"><i class="bi bi-arrow-left me-1"></i>Back to Billing</a></div>
<div class="page-title">Add Billing Record</div>
<div class="page-subtitle">Create a new billing entry for a project</div>
<div class="card" style="max-width:640px;">
    <div class="card-body p-4">
        <form action="{{ route('billing.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select @error('project_id') is-invalid @enderror" required>
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" {{ old('project_id') == $project->project_id ? 'selected' : '' }}>
                        {{ $project->project_name }} (&#8369;{{ number_format($project->contract_price,2) }})
                    </option>
                    @endforeach
                </select>
                @error('project_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Billing Type <span class="text-danger">*</span></label>
                    <select name="billing_type" class="form-select @error('billing_type') is-invalid @enderror" required>
                        <option value="">-- Select Type --</option>
                        @foreach(['Downpayment','Progress','Final'] as $t)
                        <option value="{{ $t }}" {{ old('billing_type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('billing_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Billing Date <span class="text-danger">*</span></label>
                    <input type="date" name="billing_date" class="form-control @error('billing_date') is-invalid @enderror" value="{{ old('billing_date', date('Y-m-d')) }}" required>
                    @error('billing_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Billed (&#8369;) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="amount_billed" class="form-control @error('amount_billed') is-invalid @enderror" value="{{ old('amount_billed') }}" required>
                    @error('amount_billed')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Paid (&#8369;)</label>
                    <input type="number" step="0.01" name="amount_paid" class="form-control" value="{{ old('amount_paid', 0) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                <select name="payment_status" class="form-select" required>
                    @foreach(['Unpaid','Partial','Paid'] as $s)
                    <option value="{{ $s }}" {{ old('payment_status','Unpaid') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Save Billing</button>
                <a href="{{ route('billing.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
