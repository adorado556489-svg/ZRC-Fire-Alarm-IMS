<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Clients ──────────────────────────────────────────────────
        DB::table('clients')->insert([
            ['client_name' => 'Greenfield Towers Inc.', 'contact_person' => 'Ramon Dela Cruz', 'address' => 'Makati City, Metro Manila', 'phone' => '0917-111-2222', 'email' => 'ramon@greenfield.com', 'created_at' => now(), 'updated_at' => now()],
            ['client_name' => 'SunBridge Mall Corp.', 'contact_person' => 'Liza Santos', 'address' => 'Cebu City, Cebu', 'phone' => '0918-333-4444', 'email' => 'liza@sunbridge.com', 'created_at' => now(), 'updated_at' => now()],
            ['client_name' => 'Metro Pacific Hospital', 'contact_person' => 'Dr. James Ramos', 'address' => 'Quezon City, Metro Manila', 'phone' => '0919-555-6666', 'email' => 'jramos@metropacific.ph', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── Suppliers ─────────────────────────────────────────────────
        DB::table('suppliers')->insert([
            ['supplier_name' => 'Firepro Systems PH', 'contact_person' => 'Bong Villanueva', 'address' => 'Mandaluyong City', 'phone' => '02-8123-4567', 'email' => 'sales@firepro.ph', 'created_at' => now(), 'updated_at' => now()],
            ['supplier_name' => 'SafeGuard Electrical Supply', 'contact_person' => 'Maricel Cruz', 'address' => 'Pasig City', 'phone' => '02-8765-4321', 'email' => 'info@safeguard.com', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── Materials ─────────────────────────────────────────────────
        DB::table('materials')->insert([
            ['supplier_id' => 1, 'material_name' => 'Smoke Detector', 'brand' => 'Notifier', 'unit' => 'pcs', 'unit_price' => 1500.00, 'created_at' => now(), 'updated_at' => now()],
            ['supplier_id' => 1, 'material_name' => 'Fire Alarm Control Panel', 'brand' => 'Honeywell', 'unit' => 'unit', 'unit_price' => 35000.00, 'created_at' => now(), 'updated_at' => now()],
            ['supplier_id' => 1, 'material_name' => 'Heat Detector', 'brand' => 'System Sensor', 'unit' => 'pcs', 'unit_price' => 1200.00, 'created_at' => now(), 'updated_at' => now()],
            ['supplier_id' => 2, 'material_name' => 'Alarm Bell (6 inch)', 'brand' => 'Generic', 'unit' => 'pcs', 'unit_price' => 850.00, 'created_at' => now(), 'updated_at' => now()],
            ['supplier_id' => 2, 'material_name' => 'Fire Alarm Cable (2-wire)', 'brand' => 'Phelps Dodge', 'unit' => 'meters', 'unit_price' => 28.50, 'created_at' => now(), 'updated_at' => now()],
            ['supplier_id' => 2, 'material_name' => 'Manual Call Point', 'brand' => 'Hochiki', 'unit' => 'pcs', 'unit_price' => 980.00, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── Quotations ────────────────────────────────────────────────
        DB::table('quotations')->insert([
            [
                'client_id' => 1, 'subject' => 'Greenfield Tower A - FA System',
                'quotation_date' => '2024-01-05', 'followup_date' => '2024-01-15',
                'amount' => 450000.00, 'status' => 'Approved',
                'remarks' => 'Full system installation',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'client_id' => 2, 'subject' => 'SunBridge Mall - Level 2 FA Upgrade',
                'quotation_date' => '2024-03-01', 'followup_date' => '2024-03-11',
                'amount' => 280000.00, 'status' => 'Approved',
                'remarks' => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'client_id' => 3, 'subject' => 'Metro Pacific Hospital - FA System',
                'quotation_date' => '2024-04-01', 'followup_date' => '2024-04-11',
                'amount' => 890000.00, 'status' => 'Pending',
                'remarks' => 'Awaiting client approval',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // ── Projects ──────────────────────────────────────────────────
        DB::table('projects')->insert([
            [
                'client_id' => 1, 'quotation_id' => 1, 'project_name' => 'Greenfield Tower A - FA System',
                'location' => 'Makati City', 'contract_price' => 450000.00, 'downpayment' => 225000.00,
                'bid_date' => '2024-01-05', 'approval_date' => '2024-01-15',
                'start_date' => '2024-02-01', 'end_date' => '2024-02-28',
                'status' => 'Completed',
                'quotation_date' => '2024-01-05', 'followup_date' => '2024-01-15',
                'quotation_status' => 'Approved', 'quotation_amount' => 450000.00, 'quotation_remarks' => 'Full system installation',
                'initial_test_date' => '2024-02-25', 'final_test_date' => '2024-02-27',
                'test_result' => 'Passed', 'tc_conducted_by' => 'Engr. Roberto Lim',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'client_id' => 2, 'quotation_id' => 2, 'project_name' => 'SunBridge Mall - Level 2 FA Upgrade',
                'location' => 'Cebu City', 'contract_price' => 280000.00, 'downpayment' => 140000.00,
                'bid_date' => '2024-03-01', 'approval_date' => '2024-03-10',
                'start_date' => '2024-03-20', 'end_date' => null,
                'status' => 'Ongoing',
                'quotation_date' => '2024-03-01', 'followup_date' => '2024-03-11',
                'quotation_status' => 'Approved', 'quotation_amount' => 280000.00, 'quotation_remarks' => null,
                'initial_test_date' => null, 'final_test_date' => null,
                'test_result' => null, 'tc_conducted_by' => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'client_id' => 3, 'project_name' => 'Metro Pacific Hospital - FA System',
                'location' => 'Quezon City', 'contract_price' => 890000.00, 'downpayment' => null,
                'bid_date' => '2024-04-01', 'approval_date' => null,
                'start_date' => null, 'end_date' => null,
                'status' => 'Bidding',
                'quotation_date' => '2024-04-01', 'followup_date' => '2024-04-11',
                'quotation_status' => 'Submitted', 'quotation_amount' => 890000.00, 'quotation_remarks' => 'Awaiting client approval',
                'initial_test_date' => null, 'final_test_date' => null,
                'test_result' => null, 'tc_conducted_by' => null,
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // ── Project Materials ─────────────────────────────────────────
        DB::table('project_materials')->insert([
            ['project_id' => 1, 'material_id' => 1, 'quantity' => 40, 'total_cost' => 60000.00, 'delivery_date' => '2024-02-03', 'delivery_status' => 'Delivered', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'material_id' => 2, 'quantity' => 2,  'total_cost' => 70000.00, 'delivery_date' => '2024-02-03', 'delivery_status' => 'Delivered', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'material_id' => 5, 'quantity' => 500,'total_cost' => 14250.00, 'delivery_date' => '2024-02-03', 'delivery_status' => 'Delivered', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'material_id' => 1, 'quantity' => 20, 'total_cost' => 30000.00, 'delivery_date' => '2024-03-22', 'delivery_status' => 'Delivered', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'material_id' => 4, 'quantity' => 10, 'total_cost' => 8500.00,  'delivery_date' => null,           'delivery_status' => 'Pending',   'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── Emp Agencies ──────────────────────────────────────────────
        DB::table('emp_agencies')->insert([
            ['project_id' => 1, 'agency_name' => 'PrimeTech Manpower Services', 'contact_person' => 'Carlo Bautista', 'phone' => '0920-777-8888', 'workers_deployed' => 6, 'date_start' => '2024-02-01', 'date_end' => '2024-02-28', 'task_assigned' => 'Fire alarm installation and wiring', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'agency_name' => 'AllPro Labor Solutions', 'contact_person' => 'Nena Flores', 'phone' => '0921-999-0000', 'workers_deployed' => 4, 'date_start' => '2024-03-20', 'date_end' => null, 'task_assigned' => 'FA system upgrade and cable installation', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── Billing ───────────────────────────────────────────────────
        DB::table('billings')->insert([
            ['project_id' => 1, 'billing_date' => '2024-01-15', 'amount_billed' => 225000.00, 'amount_paid' => 225000.00, 'payment_status' => 'Paid',    'billing_type' => 'Downpayment', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 1, 'billing_date' => '2024-03-01', 'amount_billed' => 225000.00, 'amount_paid' => 225000.00, 'payment_status' => 'Paid',    'billing_type' => 'Final',       'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'billing_date' => '2024-03-10', 'amount_billed' => 140000.00, 'amount_paid' => 140000.00, 'payment_status' => 'Paid',    'billing_type' => 'Downpayment', 'created_at' => now(), 'updated_at' => now()],
            ['project_id' => 2, 'billing_date' => '2024-04-01', 'amount_billed' => 140000.00, 'amount_paid' => 50000.00,  'payment_status' => 'Partial', 'billing_type' => 'Final',       'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
