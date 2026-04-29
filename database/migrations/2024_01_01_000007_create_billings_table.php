<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id('billing_id');
            $table->foreignId('project_id')->constrained('projects', 'project_id')->onDelete('cascade');
            $table->date('billing_date');
            $table->decimal('amount_billed', 12, 2)->default(0);
            $table->decimal('amount_paid', 12, 2)->nullable()->default(0);
            $table->enum('payment_status', ['Unpaid','Partial','Paid'])->default('Unpaid');
            $table->enum('billing_type', ['Downpayment','Progress','Final'])->default('Downpayment');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('billings'); }
};
