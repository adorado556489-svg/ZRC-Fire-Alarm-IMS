<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'supplier_id';
    protected $fillable   = ['supplier_name','contact_person','address','phone','email'];

    public function materials()
    {
        return $this->hasMany(Material::class, 'supplier_id');
    }
}
