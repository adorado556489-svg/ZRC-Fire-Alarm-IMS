<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::connection($this->getConnection())->getDriverName();

        switch ($driver) {
            case 'mysql':
            case 'mariadb':
                $this->dropReportingViewsMysql();
                $this->createReportingViewsMysql();
                break;
            case 'sqlite':
                $this->dropReportingViewsSqlite();
                $this->createReportingViewsSqlite();
                break;
            default:
                break;
        }
    }

    public function down(): void
    {
        $driver = DB::connection($this->getConnection())->getDriverName();

        switch ($driver) {
            case 'mysql':
            case 'mariadb':
                DB::statement('DROP VIEW IF EXISTS vw_project_details, vw_billing_summary, vw_project_overview');
                break;
            case 'sqlite':
                $this->dropReportingViewsSqlite();
                break;
            default:
                break;
        }
    }

    private function dropReportingViewsMysql(): void
    {
        foreach (['vw_project_details', 'vw_billing_summary', 'vw_project_overview'] as $view) {
            DB::statement("DROP VIEW IF EXISTS `{$view}`");
        }
    }

    private function dropReportingViewsSqlite(): void
    {
        foreach (['vw_project_details', 'vw_billing_summary', 'vw_project_overview'] as $view) {
            DB::statement("DROP VIEW IF EXISTS {$view}");
        }
    }

    private function createReportingViewsMysql(): void
    {
        DB::statement(<<<'SQL'
CREATE VIEW vw_project_overview AS
SELECT
    p.project_id,
    p.project_name,
    p.location,
    p.status,
    p.contract_price,
    p.start_date,
    p.end_date,
    p.test_result,
    TRIM(CONCAT_WS(' ', c.client_fname, c.client_mname, c.client_lname)) AS client_name,
    c.phone AS client_contact,
    q.subject AS quotation_subject,
    q.amount AS quotation_amount,
    q.status AS quotation_status
FROM projects p
INNER JOIN clients c ON p.client_id = c.client_id
LEFT JOIN quotations q ON p.quotation_id = q.quotation_id
SQL);

        DB::statement(<<<'SQL'
CREATE VIEW vw_billing_summary AS
SELECT
    b.billing_id AS billing_id,
    p.project_id AS project_id,
    p.project_name AS project_name,
    p.contract_price AS contract_price,
    p.status AS project_status,
    TRIM(CONCAT_WS(' ', c.client_fname, c.client_mname, c.client_lname)) AS client_name,
    c.phone AS client_contact,
    b.billing_type AS billing_type,
    b.billing_date AS billing_date,
    b.amount_billed AS amount_billed,
    COALESCE(b.amount_paid, 0) AS amount_paid,
    (CAST(b.amount_billed AS DECIMAL(14, 2)) - COALESCE(CAST(b.amount_paid AS DECIMAL(14, 2)), 0)) AS balance,
    b.payment_status AS payment_status
FROM billings b
INNER JOIN projects p ON b.project_id = p.project_id
INNER JOIN clients c ON p.client_id = c.client_id
SQL);

        DB::statement(<<<'SQL'
CREATE VIEW vw_project_details AS
SELECT
    pm.proj_mat_id AS proj_mat_id,
    p.project_id AS project_id,
    p.project_name AS project_name,
    c.client_id AS client_id,
    TRIM(CONCAT_WS(' ', c.client_fname, c.client_mname, c.client_lname)) AS client_name,
    c.phone AS client_contact,
    m.material_id AS material_id,
    m.material_name AS material_name,
    m.brand AS brand,
    m.unit AS unit,
    m.unit_price AS unit_price,
    pm.quantity AS quantity,
    (CAST(m.unit_price AS DECIMAL(10, 2)) * pm.quantity) AS total_price,
    pm.delivery_status AS delivery_status,
    pm.delivery_date AS delivery_date,
    p.location AS location,
    p.status AS status,
    p.start_date AS start_date,
    p.end_date AS end_date
FROM projects p
INNER JOIN clients c ON p.client_id = c.client_id
INNER JOIN project_materials pm ON p.project_id = pm.project_id
INNER JOIN materials m ON pm.material_id = m.material_id
SQL);
    }

    private function createReportingViewsSqlite(): void
    {
        DB::statement(<<<'SQL'
CREATE VIEW vw_project_overview AS
SELECT
    p.project_id AS project_id,
    p.project_name AS project_name,
    p.location AS location,
    p.status AS status,
    p.contract_price AS contract_price,
    p.start_date AS start_date,
    p.end_date AS end_date,
    p.test_result AS test_result,
    TRIM(COALESCE(c.client_fname, '') || ' ' || COALESCE(c.client_mname, '') || ' ' || COALESCE(c.client_lname, '')) AS client_name,
    c.phone AS client_contact,
    q.subject AS quotation_subject,
    q.amount AS quotation_amount,
    q.status AS quotation_status
FROM projects p
INNER JOIN clients c ON p.client_id = c.client_id
LEFT JOIN quotations q ON p.quotation_id = q.quotation_id
SQL);

        DB::statement(<<<'SQL'
CREATE VIEW vw_billing_summary AS
SELECT
    b.billing_id AS billing_id,
    p.project_id AS project_id,
    p.project_name AS project_name,
    p.contract_price AS contract_price,
    p.status AS project_status,
    TRIM(COALESCE(c.client_fname, '') || ' ' || COALESCE(c.client_mname, '') || ' ' || COALESCE(c.client_lname, '')) AS client_name,
    c.phone AS client_contact,
    b.billing_type AS billing_type,
    b.billing_date AS billing_date,
    b.amount_billed AS amount_billed,
    COALESCE(b.amount_paid, 0) AS amount_paid,
    (IFNULL(b.amount_billed, 0) - IFNULL(b.amount_paid, 0)) AS balance,
    b.payment_status AS payment_status
FROM billings b
INNER JOIN projects p ON b.project_id = p.project_id
INNER JOIN clients c ON p.client_id = c.client_id
SQL);

        DB::statement(<<<'SQL'
CREATE VIEW vw_project_details AS
SELECT
    pm.proj_mat_id AS proj_mat_id,
    p.project_id AS project_id,
    p.project_name AS project_name,
    c.client_id AS client_id,
    TRIM(COALESCE(c.client_fname, '') || ' ' || COALESCE(c.client_mname, '') || ' ' || COALESCE(c.client_lname, '')) AS client_name,
    c.phone AS client_contact,
    m.material_id AS material_id,
    m.material_name AS material_name,
    m.brand AS brand,
    m.unit AS unit,
    m.unit_price AS unit_price,
    pm.quantity AS quantity,
    (m.unit_price * pm.quantity) AS total_price,
    pm.delivery_status AS delivery_status,
    pm.delivery_date AS delivery_date,
    p.location AS location,
    p.status AS status,
    p.start_date AS start_date,
    p.end_date AS end_date
FROM projects p
INNER JOIN clients c ON p.client_id = c.client_id
INNER JOIN project_materials pm ON p.project_id = pm.project_id
INNER JOIN materials m ON pm.material_id = m.material_id
SQL);
    }
};
