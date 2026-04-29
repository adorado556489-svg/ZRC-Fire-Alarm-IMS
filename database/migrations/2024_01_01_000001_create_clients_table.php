<?php
// =========================================================
// FILE: database/migrations/2024_01_01_000001_create_clients_table.php
// =========================================================
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('client_fname', 100);
            $table->string('client_mname', 100)->nullable();
            $table->string('client_lname', 100);
            $table->string('contact_person', 100);
            $table->text('address')->nullable();
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('clients'); }
};
