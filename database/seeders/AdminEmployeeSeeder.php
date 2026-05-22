<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminEmployeeSeeder extends Seeder
{
    /**
     * Seed a one-time admin employee account.
     *
     * Run:
     * php artisan db:seed --class=AdminEmployeeSeeder
     */
    public function run(): void
    {
        $username = env('ADMIN_USERNAME', 'admin');

        if (Employee::query()->where('username', $username)->exists()) {
            $this->command?->warn("Admin username '{$username}' already exists. Skipping.");
            return;
        }

        Employee::query()->create([
            'emp_Fname' => env('ADMIN_EMP_FNAME', 'Arfred'),
            'emp_Lname' => env('ADMIN_EMP_LNAME', 'Dorado'),
            'emp_Mname' => env('ADMIN_EMP_MNAME', 'A'),
            'phone' => env('ADMIN_PHONE', '09941054287'),
            'email' => env('ADMIN_EMAIL', 'admin@example.com'),
            'username' => $username,
            'password_hash' => Hash::make(env('ADMIN_PASSWORD', 'admin123')),
        ]);

        $this->command?->info("Admin employee '{$username}' created.");
    }
}
