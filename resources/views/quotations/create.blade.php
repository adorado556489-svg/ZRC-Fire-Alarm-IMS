@extends('layouts.app')
@section('title', 'Create Quotation')
@section('content')
<div class="mb-3"><a href="{{ route('quotations.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Quotations</a></div>
<div class="page-title">Create Quotation</div>
<div class="page-subtitle">Record bid details before creating a project</div>
<div class="card" style="max-width:780px;">
    <div class="card-body p-4">
        <form action="{{ route('quotations.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Client <span class="text-danger">*</span></label>
                <select name="client_id" class="form-select @error('client_id') is-invalid @enderror" required>
                    <option value="">-- Select Client --</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->client_id }}" {{ old('client_id') == $client->client_id ? 'selected' : '' }}>{{ $client->client_name }}</option>
                    @endforeach
                </select>
                @error('client_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Quotation Subject <span class="text-danger">*</span></label>
                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="e.g. Fire Alarm System for Building A" required>
                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Quotation Date <span class="text-danger">*</span></label>
                    <input type="date" name="quotation_date" class="form-control @error('quotation_date') is-invalid @enderror" value="{{ old('quotation_date', now()->toDateString()) }}" required>
                    @error('quotation_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Follow-up Date <small class="text-muted">(+10 days default)</small></label>
                    <input type="date" name="followup_date" class="form-control @error('followup_date') is-invalid @enderror" value="{{ old('followup_date') }}">
                    @error('followup_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                        @foreach(['Pending', 'Approved', 'Rejected'] as $status)
                        <option value="{{ $status }}" {{ old('status', 'Pending') === $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Amount (PHP) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" required>
                @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" rows="3" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks') }}</textarea>
                @error('remarks')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i>Save Quotation</button>
                <a href="{{ route('quotations.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
