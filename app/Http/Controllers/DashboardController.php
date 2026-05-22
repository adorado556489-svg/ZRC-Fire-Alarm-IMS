<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Client;
use App\Models\Material;
use App\Models\Project;
use App\Models\VwBillingSummary;
use App\Models\VwProjectDetails;
use App\Models\VwProjectOverview;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'clients' => Client::count(),
            'projects' => Project::count(),
            'materials' => Material::count(),
            'billing' => Billing::count(),
        ];
        $recentProjects = VwProjectOverview::query()
            ->orderByDesc('project_id')
            ->take(6)
            ->get();
        $recentBilling = VwBillingSummary::query()
            ->orderByDesc('billing_date')
            ->orderByDesc('billing_id')
            ->take(5)
            ->get();
        $recentProjectMaterials = VwProjectDetails::query()
            ->orderByDesc('proj_mat_id')
            ->take(6)
            ->get();

        return view('dashboard', compact('counts', 'recentProjects', 'recentBilling', 'recentProjectMaterials'));
    }
}
