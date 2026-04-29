<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('emp_agencies', function (Blueprint $table) {
            $table->id('agency_id');
            $table->foreignId('project_id')->constrained('projects', 'project_id')->onDelete('cascade');
            $table->string('agency_name', 150);
            $table->string('contact_person', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->integer('workers_deployed')->default(1);
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->string('task_assigned', 200)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('emp_agencies'); }
};
