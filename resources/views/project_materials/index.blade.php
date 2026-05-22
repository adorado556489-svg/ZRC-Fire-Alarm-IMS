@extends('layouts.app')
@section('title', 'Project Materials')
@section('content')
<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
    <div><div class="page-title">Project Materials</div><div class="page-subtitle">Materials assigned to each project</div></div>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <form method="GET" action="{{ route('project-materials.index') }}" class="m-0">
            <label class="visually-hidden" for="filterProjectPm">Filter by project</label>
            <select name="project_id" id="filterProjectPm" class="form-select form-select-sm" style="min-width:220px" onchange="this.form.submit()">
                <option value="">All Projects</option>
                @foreach($projects as $project)
                <option value="{{ $project->project_id }}" @selected((string) request('project_id') === (string) $project->project_id)>{{ $project->project_name }}</option>
                @endforeach
            </select>
        </form>
        <a href="{{ route('project-materials.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i>Assign Material</a>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-3">Project</th>
                    <th>Material</th>
                    <th>Quantity</th>
                    <th>Total Cost</th>
                    <th>Delivery Date</th>
                    <th>Delivery Status</th>
                    <th class="text-end pe-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projectMaterials as $pm)
                @php $ds = ['Pending'=>'warning','Delivered'=>'success','Partial'=>'info']; @endphp
                <tr>
                    <td class="ps-3">{{ $pm->project_name }}</td>
                    <td>{{ $pm->material_name }}</td>
                    <td>{{ $pm->quantity }} {{ $pm->unit ?? '' }}</td>
                    <td>&#8369;{{ number_format($pm->total_price, 2) }}</td>
                    <td>{{ $pm->delivery_date ? \Carbon\Carbon::parse($pm->delivery_date)->format('M d, Y') : '—' }}</td>
                    <td><span class="badge bg-{{ $ds[$pm->delivery_status] ?? 'secondary' }} badge-status">{{ $pm->delivery_status }}</span></td>
                    <td class="text-end pe-3">
                        <a href="{{ route('project-materials.edit', ['project_material' => $pm->proj_mat_id]) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('project-materials.destroy', ['project_material' => $pm->proj_mat_id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this material entry?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No project materials yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($projectMaterials->hasPages())
    <div class="card-footer bg-white">{{ $projectMaterials->links() }}</div>
    @endif
</div>
@endsection
