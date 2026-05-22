@extends('layouts.app')
@section('title', 'Project Details')
@section('content')
<div class="mb-3"><a href="{{ route('projects.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Projects</a></div>
@php $colors = ['Bidding'=>'secondary','Approved'=>'primary','Ongoing'=>'warning','Completed'=>'success','Cancelled'=>'danger']; @endphp
<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <div class="page-title">{{ $project->project_name }}</div>
        <div class="page-subtitle">{{ $project->client->client_name ?? '' }} &mdash; {{ $project->location ?? 'No location' }}</div>
    </div>
    <div class="d-flex gap-2">
        <span class="badge bg-{{ $colors[$project->status] ?? 'secondary' }} px-3 py-2" style="font-size:13px;">{{ $project->status }}</span>
        <a href="{{ route('projects.edit', $project) }}" class="btn btn-danger"><i class="bi bi-pencil me-1"></i>Edit</a>
    </div>
</div>
<div class="row g-3">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header"><i class="bi bi-info-circle me-2"></i>Project Details</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><td class="text-muted" style="width:160px;">Contract Price</td><td><strong>₱{{ number_format($project->contract_price, 2) }}</strong></td></tr>
                    <tr><td class="text-muted">Start Date</td><td>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d, Y') : '—' }}</td></tr>
                    <tr><td class="text-muted">End Date</td><td>{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('M d, Y') : '—' }}</td></tr>
                    <tr><td class="text-muted">Bid Date</td><td>{{ $project->bid_date ? \Carbon\Carbon::parse($project->bid_date)->format('M d, Y') : '—' }}</td></tr>
                    <tr><td class="text-muted">Approval Date</td><td>{{ $project->approval_date ? \Carbon\Carbon::parse($project->approval_date)->format('M d, Y') : '—' }}</td></tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><i class="bi bi-file-text me-2"></i>Quotation</div>
            <div class="card-body">
                @if($project->quotation)
                <table class="table table-sm table-borderless mb-0">
                    <tr><td class="text-muted" style="width:160px;">Subject</td><td>{{ $project->quotation->subject }}</td></tr>
                    <tr><td class="text-muted">Quotation Date</td><td>{{ $project->quotation->quotation_date ? \Carbon\Carbon::parse($project->quotation->quotation_date)->format('M d, Y') : '—' }}</td></tr>
                    <tr><td class="text-muted">Follow-up Date</td><td>{{ $project->quotation->followup_date ? \Carbon\Carbon::parse($project->quotation->followup_date)->format('M d, Y') : '—' }}</td></tr>
                    <tr><td class="text-muted">Status</td><td>{{ $project->quotation->status }}</td></tr>
                    <tr><td class="text-muted">Amount</td><td>₱{{ number_format($project->quotation->amount, 2) }}</td></tr>
                    <tr><td class="text-muted">Remarks</td><td>{{ $project->quotation->remarks ?: '—' }}</td></tr>
                </table>
                @else
                <p class="text-muted mb-0">No linked quotation. This is likely a legacy project record.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header"><i class="bi bi-check2-circle me-2"></i>Testing & Commissioning</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><td class="text-muted" style="width:160px;">Initial Test</td><td>{{ $project->initial_test_date ?? '—' }}</td></tr>
                    <tr><td class="text-muted">Final Test</td><td>{{ $project->final_test_date ?? '—' }}</td></tr>
                    <tr><td class="text-muted">Result</td><td>
                        @if($project->test_result)
                        <span class="badge bg-{{ ['Passed'=>'success','Failed'=>'danger','Pending'=>'warning'][$project->test_result] ?? 'secondary' }} badge-status">{{ $project->test_result }}</span>
                        @else —@endif
                    </td></tr>
                    <tr><td class="text-muted">Conducted By</td><td>{{ $project->tc_conducted_by ?? '—' }}</td></tr>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><i class="bi bi-receipt me-2"></i>Billing ({{ $project->billing->count() }})</div>
            @php
                $totalAmountPaid = $project->billing->sum(function ($bill) {
                    $amountPaid = (float) ($bill->amount_paid ?? 0);
                    $amountBilled = (float) ($bill->amount_billed ?? 0);

                    if ($amountPaid > 0) {
                        return $amountPaid;
                    }

                    return $bill->payment_status === 'Paid' ? $amountBilled : 0;
                });
                $remainingBalance = max(((float) ($project->contract_price ?? 0)) - $totalAmountPaid, 0);
            @endphp
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead class="table-light"><tr><th class="ps-3">Type</th><th>Amount</th><th>Status</th></tr></thead>
                    <tbody>
                        @forelse($project->billing as $b)
                        <tr>
                            <td class="ps-3">{{ $b->billing_type }}</td>
                            <td>₱{{ number_format($b->amount_billed, 2) }}</td>
                            <td><span class="badge bg-{{ ['Paid'=>'success','Partial'=>'warning','Unpaid'=>'danger'][$b->payment_status] ?? 'secondary' }} badge-status">{{ $b->payment_status }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-2">No billing yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="border-top p-3 bg-light">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">Total Amount Paid</span>
                        <strong style="font-size:1.05rem;">₱{{ number_format($totalAmountPaid, 2) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Remaining Balance</span>
                        <strong class="text-danger" style="font-size:1.1rem;">₱{{ number_format($remainingBalance, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
