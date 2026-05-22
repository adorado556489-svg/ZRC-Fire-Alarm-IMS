@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="page-title">Dashboard</div>
<div class="page-subtitle">Overview of ZRC Fire Alarm Retailing System</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;border-radius:12px;background:#fdecea;display:flex;align-items:center;justify-content:center;font-size:22px;color:#c0392b;">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div style="font-size:24px;font-weight:700;color:#1a1a2e;">{{ $counts['clients'] }}</div>
                    <div style="font-size:12px;color:#6c757d;">Total Clients</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;border-radius:12px;background:#e8f4fd;display:flex;align-items:center;justify-content:center;font-size:22px;color:#2980b9;">
                    <i class="bi bi-folder2-open"></i>
                </div>
                <div>
                    <div style="font-size:24px;font-weight:700;color:#1a1a2e;">{{ $counts['projects'] }}</div>
                    <div style="font-size:12px;color:#6c757d;">Total Projects</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;border-radius:12px;background:#eafaf1;display:flex;align-items:center;justify-content:center;font-size:22px;color:#27ae60;">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div>
                    <div style="font-size:24px;font-weight:700;color:#1a1a2e;">{{ $counts['materials'] }}</div>
                    <div style="font-size:12px;color:#6c757d;">Materials</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:48px;height:48px;border-radius:12px;background:#fef9e7;display:flex;align-items:center;justify-content:center;font-size:22px;color:#f39c12;">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <div style="font-size:24px;font-weight:700;color:#1a1a2e;">{{ $counts['billing'] }}</div>
                    <div style="font-size:12px;color:#6c757d;">Billing Records</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span><i class="bi bi-folder2-open me-2 text-danger"></i>Recent Projects</span>
                <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Project</th>
                            <th>Client</th>
                            <th>Status</th>
                            <th>Contract Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProjects as $project)
                        <tr>
                            <td class="ps-3">{{ $project->project_name }}</td>
                            <td>{{ trim((string) $project->client_name) !== '' ? $project->client_name : '—' }}</td>
                            <td>
                                @php
                                    $colors = ['Bidding'=>'secondary','Approved'=>'primary','Ongoing'=>'warning','Completed'=>'success','Cancelled'=>'danger'];
                                    $c = $colors[$project->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $c }} badge-status">{{ $project->status }}</span>
                            </td>
                            <td>₱{{ number_format($project->contract_price, 2) }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">No projects yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span><i class="bi bi-receipt me-2 text-danger"></i>Recent Billing</span>
                <a href="{{ route('billing.index') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Project</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBilling as $bill)
                        <tr>
                            <td class="ps-3">{{ $bill->project_name }}</td>
                            <td>₱{{ number_format($bill->amount_billed, 2) }}</td>
                            <td>
                                @php $bc = ['Paid'=>'success','Partial'=>'warning','Unpaid'=>'danger'][$bill->payment_status] ?? 'secondary'; @endphp
                                <span class="badge bg-{{ $bc }} badge-status">{{ $bill->payment_status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">No billing yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span><i class="bi bi-diagram-3 me-2 text-danger"></i>Recent Project Materials</span>
                <a href="{{ route('project-materials.index') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Project</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Line Total</th>
                            <th>Delivery</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProjectMaterials as $pm)
                        @php $ds = ['Pending'=>'warning','Delivered'=>'success','Partial'=>'info']; @endphp
                        <tr>
                            <td class="ps-3">{{ $pm->project_name }}</td>
                            <td>{{ $pm->material_name }}</td>
                            <td>{{ $pm->quantity }} {{ $pm->unit ?? '' }}</td>
                            <td>₱{{ number_format($pm->total_price, 2) }}</td>
                            <td><span class="badge bg-{{ $ds[$pm->delivery_status] ?? 'secondary' }} badge-status">{{ $pm->delivery_status }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">No project materials assigned yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
