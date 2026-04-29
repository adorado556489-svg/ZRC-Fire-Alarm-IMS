<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $primaryKey = 'quotation_id';

    protected $fillable = [
        'client_id',
        'subject',
        'quotation_date',
        'followup_date',
        'amount',
        'status',
        'remarks',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'quotation_id', 'quotation_id');
    }
}
