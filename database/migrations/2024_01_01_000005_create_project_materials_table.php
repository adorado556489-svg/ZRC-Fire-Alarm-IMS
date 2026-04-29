<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_materials', function (Blueprint $table) {
            $table->id('proj_mat_id');
            $table->foreignId('project_id')->constrained('projects', 'project_id')->onDelete('cascade');
            $table->foreignId('material_id')->constrained('materials', 'material_id')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->date('delivery_date')->nullable();
            $table->enum('delivery_status', ['Pending','Delivered','Partial'])->default('Pending');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('project_materials'); }
};
