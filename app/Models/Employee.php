<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $table = 'employee';

    protected $primaryKey = 'employee_id';

    public $timestamps = false;

    protected $fillable = [
        'emp_Fname',
        'emp_Lname',
        'emp_Mname',
        'phone',
        'email',
        'username',
        'password_hash',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    public function getDisplayNameAttribute(): string
    {
        return trim("{$this->emp_Fname} {$this->emp_Lname}");
    }
}
