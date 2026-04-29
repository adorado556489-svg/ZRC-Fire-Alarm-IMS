<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $primaryKey = 'material_id';
    protected $fillable   = ['supplier_id','material_name','brand','unit','unit_price'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function projectMaterials()
    {
        return $this->hasMany(ProjectMaterial::class, 'material_id');
    }
}
