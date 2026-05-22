@extends('layouts.app')
@section('title', 'Quotation Details')
@section('content')
<div class="mb-3"><a href="{{ route('quotations.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Quotations</a></div>
@php $colors = ['Pending' => 'warning', 'Approved' => 'success', 'Rejected' => 'danger']; @endphp
<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <div class="page-title">{{ $quotation->subject }}</div>
        <div class="page-subtitle">{{ $quotation->client->client_name ?? '' }}</div>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-{{ $colors[$quotation->status] ?? 'secondary' }} px-3 py-2" style="font-size:13px;">{{ $quotation->status }}</span>
        <a href="{{ route('quotations.edit', $quotation) }}" class="btn btn-danger"><i class="bi bi-pencil me-1"></i>Edit</a>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header"><i class="bi bi-file-text me-2"></i>Quotation Details</div>
    <div class="card-body">
        <table class="table table-sm table-borderless mb-0">
            <tr><td class="text-muted" style="width:180px;">Quotation Date</td><td>{{ \Carbon\Carbon::parse($quotation->quotation_date)->format('M d, Y') }}</td></tr>
            <tr><td class="text-muted">Follow-up Date</td><td>{{ $quotation->followup_date ? \Carbon\Carbon::parse($quotation->followup_date)->format('M d, Y') : '—' }}</td></tr>
            <tr><td class="text-muted">Amount</td><td><strong>₱{{ number_format($quotation->amount, 2) }}</strong></td></tr>
            <tr><td class="text-muted">Remarks</td><td>{{ $quotation->remarks ?: '—' }}</td></tr>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header"><i class="bi bi-folder2-open me-2"></i>Project Conversion</div>
    <div class="card-body">
        @if($quotation->project)
            <p class="mb-3">This quotation has already been converted to a project.</p>
            <a href="{{ route('projects.show', $quotation->project) }}" class="btn btn-outline-primary"><i class="bi bi-eye me-1"></i>View Project</a>
        @elseif($quotation->status === 'Approved')
            <p class="mb-3">This quotation is approved and ready to become a project.</p>
            <form action="{{ route('quotations.create-project', $quotation) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-success"><i class="bi bi-folder-plus me-1"></i>Create Project from Quotation</button>
            </form>
        @else
            <p class="mb-0 text-muted">Only approved quotations can be converted into projects.</p>
        @endif
    </div>
</div>
@endsection
