@extends('layouts.app')
@section('title', 'Quotations')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div><div class="page-title">Quotations</div><div class="page-subtitle">Track pending, approved, and rejected bids</div></div>
    <a href="{{ route('quotations.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Create Quotation</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Subject</th>
                    <th>Client</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Follow-up</th>
                    <th class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($quotations as $quotation)
                @php $colors = ['Pending' => 'warning', 'Approved' => 'success', 'Rejected' => 'danger']; @endphp
                <tr>
                    <td class="ps-3"><strong>{{ $quotation->subject }}</strong></td>
                    <td>{{ $quotation->client->client_name ?? '—' }}</td>
                    <td>₱{{ number_format($quotation->amount, 2) }}</td>
                    <td><span class="badge bg-{{ $colors[$quotation->status] ?? 'secondary' }} badge-status">{{ $quotation->status }}</span></td>
                    <td>{{ $quotation->followup_date ? \Carbon\Carbon::parse($quotation->followup_date)->format('M d, Y') : '—' }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('quotations.show', $quotation) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('quotations.edit', $quotation) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        @if($quotation->status === 'Approved' && !$quotation->project)
                        <form action="{{ route('quotations.create-project', $quotation) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-outline-success me-1" title="Create project from this quotation"><i class="bi bi-folder-plus"></i></button>
                        </form>
                        @endif
                        <form action="{{ route('quotations.destroy', $quotation) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this quotation?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No quotations found. <a href="{{ route('quotations.create') }}">Create one now.</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($quotations->hasPages())
    <div class="card-footer bg-white">{{ $quotations->links() }}</div>
    @endif
</div>
@endsection
