<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::query()->create([
            'name' => 'Mohamad',
            'email' => 'mohamad@gmail.com',
            'phone' => '01007363331',
            'password' => Hash::make('3291673465'),
            'address' => 'sadat city'
        ]);
    }
}
