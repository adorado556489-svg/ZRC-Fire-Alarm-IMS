<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Read-only: ms to vw_project_overviewap */
class VwProjectOverview extends Model
{
    protected $table = 'vw_project_overview';

    protected $primaryKey = 'project_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $guarded = ['*'];

    protected function casts(): array
    {
        return [
            'contract_price' => 'decimal:2',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'quotation_amount' => 'decimal:2',
        ];
    }
}
