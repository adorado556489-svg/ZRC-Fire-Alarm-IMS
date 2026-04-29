<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmpAgency extends Model
{
    protected $primaryKey = 'agency_id';
    protected $fillable   = [
        'project_id','agency_name','contact_person','phone',
        'workers_deployed','date_start','date_end','task_assigned',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
