<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection($this->getConnection())->getDriverName();
        if (!in_array($driver, ['mysql', 'mariadb'], true)) {
            return;
        }

        DB::unprepared('DROP TRIGGER IF EXISTS trg_after_project_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_before_billing_update');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_before_pm_insert');

        DB::unprepared(
            "CREATE TRIGGER trg_after_project_insert
            AFTER INSERT ON projects
            FOR EACH ROW
            INSERT INTO billings (
                project_id,
                billing_date,
                amount_billed,
                amount_paid,
                payment_status,
                billing_type,
                created_at,
                updated_at
            )
            VALUES (
                NEW.project_id,
                CURDATE(),
                NEW.contract_price,
                0.00,
                'Unpaid',
                'Downpayment',
                NOW(),
                NOW()
            )"
        );

        DB::unprepared(
            "CREATE TRIGGER trg_before_billing_update
            BEFORE UPDATE ON billings
            FOR EACH ROW
            SET NEW.payment_status =
                CASE
                    WHEN NEW.amount_paid <= 0 THEN 'Unpaid'
                    WHEN NEW.amount_paid >= NEW.amount_billed THEN 'Paid'
                    ELSE 'Partial'
                END"
        );

        DB::unprepared(
            "CREATE TRIGGER trg_before_pm_insert
            BEFORE INSERT ON project_materials
            FOR EACH ROW
            SET NEW.total_cost = (
                SELECT unit_price
                FROM materials
                WHERE material_id = NEW.material_id
                LIMIT 1
            ) * NEW.quantity"
        );
    }

    public function down(): void
    {
        $driver = DB::connection($this->getConnection())->getDriverName();
        if (!in_array($driver, ['mysql', 'mariadb'], true)) {
            return;
        }

        DB::unprepared('DROP TRIGGER IF EXISTS trg_after_project_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_before_billing_update');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_before_pm_insert');
    }
};

