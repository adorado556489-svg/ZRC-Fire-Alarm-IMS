@extends('layouts.app')
@section('title', 'Client Details')
@section('content')
<div class="mb-3"><a href="{{ route('clients.index') }}" class="btn btn btn-outline-dark btn-sm"><i class="bi bi-arrow-left me-1"></i>Back to Clients</a></div>
<div class="d-flex justify-content-between align-items-start mb-3">
    <div><div class="page-title">{{ $client->full_name }}</div><div class="page-subtitle">Client Details</div></div>
    <a href="{{ route('clients.edit', $client) }}" class="btn btn-danger"><i class="bi bi-pencil me-1"></i>Edit</a>
</div>
<div class="row g-3">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><i class="bi bi-person me-2"></i>Contact Information</div>
            <div class="card-body">
                <table class="table table-sm table-borderless mb-0">
                    <tr><td class="text-muted" style="width:140px;">Contact Person</td><td><strong>{{ $client->contact_person }}</strong></td></tr>
                    <tr><td class="text-muted">Phone</td><td>{{ $client->phone }}</td></tr>
                    <tr><td class="text-muted">Email</td><td>{{ $client->email ?? '—' }}</td></tr>
                    <tr><td class="text-muted">Address</td><td>{{ $client->address ?? '—' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><i class="bi bi-folder2-open me-2"></i>Projects ({{ $client->projects->count() }})</div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light"><tr><th class="ps-3">Project</th><th>Status</th><th>Contract</th></tr></thead>
                    <tbody>
                        @forelse($client->projects as $p)
                        <tr>
                            <td class="ps-3"><a href="{{ route('projects.show', $p) }}" class="text-decoration-none">{{ $p->project_name }}</a></td>
                            <td><span class="badge bg-secondary badge-status">{{ $p->status }}</span></td>
                            <td>₱{{ number_format($p->contract_price, 2) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">No projects yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
