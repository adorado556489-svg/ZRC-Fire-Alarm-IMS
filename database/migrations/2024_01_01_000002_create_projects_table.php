<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id('project_id');
            $table->foreignId('client_id')->constrained('clients', 'client_id')->onDelete('cascade');
            $table->string('project_name', 200);
            $table->string('location')->nullable();
            $table->decimal('contract_price', 12, 2)->default(0);
            $table->decimal('downpayment', 12, 2)->nullable();
            $table->date('bid_date')->nullable();
            $table->date('approval_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['Bidding','Approved','Ongoing','Completed','Cancelled'])->default('Bidding');
            // Quotation fields (folded in)
            $table->date('quotation_date')->nullable();
            $table->date('followup_date')->nullable();
            $table->enum('quotation_status', ['Submitted','Approved','Rejected'])->nullable();
            $table->decimal('quotation_amount', 12, 2)->nullable();
            $table->text('quotation_remarks')->nullable();
            // Testing & Commissioning fields (folded in)
            $table->date('initial_test_date')->nullable();
            $table->date('final_test_date')->nullable();
            $table->enum('test_result', ['Passed','Failed','Pending'])->nullable();
            $table->string('tc_conducted_by')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('projects'); }
};
