<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';
    protected $fillable   = [
        'client_id','quotation_id','project_name','location','contract_price','downpayment',
        'bid_date','approval_date','start_date','end_date','status',
        'quotation_date','followup_date','quotation_status','quotation_amount','quotation_remarks',
        'initial_test_date','final_test_date','test_result','tc_conducted_by',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id', 'quotation_id');
    }

    public function projectMaterials()
    {
        return $this->hasMany(ProjectMaterial::class, 'project_id');
    }

    public function empAgencies()
    {
        return $this->hasMany(EmpAgency::class, 'project_id');
    }

    public function billing()
    {
        return $this->hasMany(Billing::class, 'project_id');
    }
}
