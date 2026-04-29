@extends('layouts.app')
@section('title', 'Billing')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div><div class="page-title">Billing</div><div class="page-subtitle">Project billing and payment records</div></div>
    <a href="{{ route('billing.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Add Billing</a>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Project</th>
                    <th>Billing Type</th>
                    <th>Billing Date</th>
                    <th>Amount Billed</th>
                    <th>Amount Paid</th>
                    <th>Payment Status</th>
                    <th class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($billings as $bill)
                @php $pc = ['Paid'=>'success','Partial'=>'warning','Unpaid'=>'danger']; @endphp
                <tr>
                    <td class="ps-3"><strong>{{ $bill->project->project_name ?? '—' }}</strong></td>
                    <td>{{ $bill->billing_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($bill->billing_date)->format('M d, Y') }}</td>
                    <td>&#8369;{{ number_format($bill->amount_billed, 2) }}</td>
                    <td>&#8369;{{ number_format($bill->amount_paid ?? 0, 2) }}</td>
                    <td><span class="badge bg-{{ $pc[$bill->payment_status] ?? 'secondary' }} badge-status">{{ $bill->payment_status }}</span></td>
                    <td class="text-end pe-3">
                        <a href="{{ route('billing.edit', $bill) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('billing.destroy', $bill) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this billing record?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No billing records yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($billings->hasPages())
    <div class="card-footer bg-white">{{ $billings->links() }}</div>
    @endif
</div>
@endsection
