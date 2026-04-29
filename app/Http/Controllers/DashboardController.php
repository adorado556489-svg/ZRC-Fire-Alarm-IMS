<?php
namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Project;
use App\Models\Material;
use App\Models\Billing;

class DashboardController extends Controller
{
    public function index()
    {
        $counts = [
            'clients'   => Client::count(),
            'projects'  => Project::count(),
            'materials' => Material::count(),
            'billing'   => Billing::count(),
        ];
        $recentProjects = Project::with('client')->latest()->take(6)->get();
        $recentBilling  = Billing::with('project')->latest()->take(5)->get();
        return view('dashboard', compact('counts', 'recentProjects', 'recentBilling'));
    }
}
