@extends('layouts.app')
@section('title', 'Employment Agency')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div><div class="page-title">Employment Agency</div><div class="page-subtitle">Contractual manpower agencies per project</div></div>
    <a href="{{ route('emp-agency.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Add Agency</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Agency Name</th>
                    <th>Project</th>
                    <th>Contact Person</th>
                    <th>Workers</th>
                    <th>Date Start</th>
                    <th>Date End</th>
                    <th>Task Assigned</th>
                    <th class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($agencies as $agency)
                <tr>
                    <td class="ps-3"><strong>{{ $agency->agency_name }}</strong></td>
                    <td>{{ $agency->project->project_name ?? '—' }}</td>
                    <td>{{ $agency->contact_person ?? '—' }}</td>
                    <td><span class="badge bg-primary badge-status">{{ $agency->workers_deployed }}</span></td>
                    <td>{{ $agency->date_start ? \Carbon\Carbon::parse($agency->date_start)->format('M d, Y') : '—' }}</td>
                    <td>{{ $agency->date_end ? \Carbon\Carbon::parse($agency->date_end)->format('M d, Y') : '—' }}</td>
                    <td>{{ $agency->task_assigned ?? '—' }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('emp-agency.edit', $agency) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('emp-agency.destroy', $agency) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this agency record?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">No agency records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($agencies->hasPages())
    <div class="card-footer bg-white">{{ $agencies->links() }}</div>
    @endif
</div>
@endsection
