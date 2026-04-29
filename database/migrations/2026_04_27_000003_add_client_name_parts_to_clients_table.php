<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('clients', 'client_name')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->string('client_name', 150)->nullable();
            });
        }

        if (!Schema::hasColumn('clients', 'client_fname')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->string('client_fname', 100)->nullable();
            });
        }

        if (!Schema::hasColumn('clients', 'client_mname')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->string('client_mname', 100)->nullable();
            });
        }

        if (!Schema::hasColumn('clients', 'client_lname')) {
            Schema::table('clients', function (Blueprint $table) {
                $table->string('client_lname', 100)->nullable();
            });
        }
    }

    public function down(): void
    {
        $columnsToDrop = [];

        foreach (['client_fname', 'client_mname', 'client_lname', 'client_name'] as $column) {
            if (Schema::hasColumn('clients', $column)) {
                $columnsToDrop[] = $column;
            }
        }

        if (!empty($columnsToDrop)) {
            Schema::table('clients', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }
    }
};
