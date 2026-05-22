<?php

use App\Models\Employee;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:create-employee
    {--username= : Login username}
    {--password= : Plain password (will be hashed)}
    {--fname= : First name}
    {--lname= : Last name}
    {--mname= : Middle name}
    {--phone= : Phone number}
    {--email= : Email address}', function () {
    $username = trim((string) ($this->option('username') ?: $this->ask('Username')));
    $password = (string) ($this->option('password') ?: $this->secret('Password (input hidden)'));
    $fname = trim((string) ($this->option('fname') ?: $this->ask('First name', 'Admin')));
    $lname = trim((string) ($this->option('lname') ?: $this->ask('Last name', 'User')));
    $mname = trim((string) ($this->option('mname') ?: $this->ask('Middle name', '')));
    $phone = trim((string) ($this->option('phone') ?: $this->ask('Phone number', '')));
    $email = trim((string) ($this->option('email') ?: $this->ask('Email address', '')));

    if ($username === '' || $password === '' || $fname === '' || $lname === '') {
        $this->error('Username, password, first name, and last name are required.');
        return self::FAILURE;
    }

    if (Employee::query()->where('username', $username)->exists()) {
        $this->error("Employee username '{$username}' already exists. No changes made.");
        return self::FAILURE;
    }

    $employee = Employee::query()->create([
        'emp_Fname' => $fname,
        'emp_Lname' => $lname,
        'emp_Mname' => $mname !== '' ? $mname : null,
        'phone' => $phone !== '' ? $phone : null,
        'email' => $email !== '' ? $email : null,
        'username' => $username,
        'password_hash' => Hash::make($password),
    ]);

    $this->info('Admin employee created successfully.');
    $this->line("Employee ID: {$employee->employee_id}");
    $this->line("Username: {$employee->username}");

    return self::SUCCESS;
})->purpose('Create the first admin employee safely');
