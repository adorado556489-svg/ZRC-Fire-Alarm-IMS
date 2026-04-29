@extends('layouts.app')
@section('title', 'Clients')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <div class="page-title">Clients</div>
        <div class="page-subtitle">Manage your fire alarm project clients</div>
    </div>
    <a href="{{ route('clients.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Add Client</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">#</th>
                    <th>Client Name</th>
                    <th>Contact Person</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr>
                    <td class="ps-3 text-muted">{{ $client->client_id }}</td>
                    <td><strong>{{ $client->full_name }}</strong></td>
                    <td>{{ $client->contact_person }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->email ?? '—' }}</td>
                    <td class="text-end pe-3">
                        <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-eye"></i></a>
                        <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this client?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No clients found. <a href="{{ route('clients.create') }}">Add one now.</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($clients->hasPages())
    <div class="card-footer bg-white">{{ $clients->links() }}</div>
    @endif
</div>
@endsection
