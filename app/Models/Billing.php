<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $primaryKey = 'billing_id';
    protected $fillable   = [
        'project_id','billing_date','amount_billed','amount_paid','payment_status','billing_type',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
