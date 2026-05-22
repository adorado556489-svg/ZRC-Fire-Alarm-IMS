<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Read-only: (1 row per prject-msterial line) */
class VwProjectDetails extends Model
{
    protected $table = 'vw_project_details';

    protected $primaryKey = 'proj_mat_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $guarded = ['*'];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'total_price' => 'decimal:2',
            'delivery_date' => 'datetime',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }
}
