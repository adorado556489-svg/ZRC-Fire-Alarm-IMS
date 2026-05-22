@extends('layouts.app')
@section('title', 'Projects')
@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
    <div><div class="page-title">Projects</div><div class="page-subtitle">All fire alarm installation projects</div></div>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <form method="GET" action="{{ route('projects.index') }}" class="m-0">
            <label class="visually-hidden" for="filterClient">Filter by client</label>
            <select name="client_id" id="filterClient" class="form-select form-select-sm" style="min-width:220px" onchange="this.form.submit()">
                <option value="">All Clients</option>
                @foreach($clients as $client)
                <option value="{{ $client->client_id }}" @selected((string) request('client_id') === (string) $client->client_id)>{{ $client->full_name }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('quotations.index') }}" class="btn btn-outline-secondary"><i class="bi bi-file-text me-1"></i>Open Quotations</a>
        <a href="{{ route('projects.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Create from Approved Quote</a>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Project Name</th>
                    <th>Client</th>
                    <th>Location</th>
                    <th>Contract Price</th>
                    <th>Status</th>
                    <th>Source Quote</th>
                    <th>Start Date</th>
                    <th class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                @php $colors = ['Bidding'=>'secondary','Approved'=>'primary','Ongoing'=>'warning','Completed'=>'success','Cancelled'=>'danger']; @endphp
                <tr>
                    <td class="ps-3"><strong>{{ $project->project_name }}</strong></td>
                    <td>{{ trim((string) $project->client_name) !== '' ? $project->client_name : '—' }}</td>
                    <td>{{ $project->location ?? '—' }}</td>
                    <td>₱{{ number_format($project->contract_price, 2) }}</td>
                    <td><span class="badge bg-{{ $colors[$project->status] ?? 'secondary' }} badge-status">{{ $project->status }}</span></td>
                    <td>{{ $project->quotation_subject ?? 'Manual / Legacy' }}</td>
                    <td>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('M d, Y') : '—' }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('projects.show', $project->project_id) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('projects.edit', $project->project_id) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('projects.destroy', $project->project_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this project?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">No projects found. <a href="{{ route('quotations.index') }}">Approve a quotation first.</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($projects->hasPages())
    <div class="card-footer bg-white">{{ $projects->links() }}</div>
    @endif
</div>
@endsection
