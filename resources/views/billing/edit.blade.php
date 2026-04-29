@extends('layouts.app')
@section('title', 'Edit Billing')
@section('content')
<div class="mb-3"><a href="{{ route('billing.index') }}" class="text-muted text-decoration-none" style="font-size:13px;"><i class="bi bi-arrow-left me-1"></i>Back to Billing</a></div>
<div class="page-title">Edit Billing Record</div>
<div class="page-subtitle">Update billing information</div>
<div class="card" style="max-width:640px;">
    <div class="card-body p-4">
        <form action="{{ route('billing.update', $billing) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Project <span class="text-danger">*</span></label>
                <select name="project_id" class="form-select" required>
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $project)
                    <option value="{{ $project->project_id }}" {{ old('project_id', $billing->project_id) == $project->project_id ? 'selected' : '' }}>
                        {{ $project->project_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Billing Type <span class="text-danger">*</span></label>
                    <select name="billing_type" class="form-select" required>
                        @foreach(['Downpayment','Progress','Final'] as $t)
                        <option value="{{ $t }}" {{ old('billing_type', $billing->billing_type) == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Billing Date <span class="text-danger">*</span></label>
                    <input type="date" name="billing_date" class="form-control" value="{{ old('billing_date', $billing->billing_date) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Billed (&#8369;) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="amount_billed" class="form-control" value="{{ old('amount_billed', $billing->amount_billed) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Amount Paid (&#8369;)</label>
                    <input type="number" step="0.01" name="amount_paid" class="form-control" value="{{ old('amount_paid', $billing->amount_paid) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Payment Status <span class="text-danger">*</span></label>
                <select name="payment_status" class="form-select" required>
                    @foreach(['Unpaid','Partial','Paid'] as $s)
                    <option value="{{ $s }}" {{ old('payment_status', $billing->payment_status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Update Billing</button>
                <a href="{{ route('billing.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
