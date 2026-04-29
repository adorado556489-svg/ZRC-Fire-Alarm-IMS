<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProjectMaterial extends Model
{
    protected $primaryKey = 'proj_mat_id';
    protected $fillable   = [
        'project_id','material_id','quantity','total_cost','delivery_date','delivery_status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
