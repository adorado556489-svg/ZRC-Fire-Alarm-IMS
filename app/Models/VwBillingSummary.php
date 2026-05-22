<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/** Read-only: to vw_billing_summary */
class VwBillingSummary extends Model
{
    protected $table = 'vw_billing_summary';

    protected $primaryKey = 'billing_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $guarded = ['*'];

    protected function casts(): array
    {
        return [
            'billing_date' => 'datetime',
            'contract_price' => 'decimal:2',
            'amount_billed' => 'decimal:2',
            'amount_paid' => 'decimal:2',
            'balance' => 'decimal:2',
        ];
    }
}
