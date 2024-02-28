<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::query()->create([
           'name' => 'Mohamad',
           'email' => 'mohamad@gmail.com',
           'age' => '21',
           'phone' => '01007363331',
           'password' => Hash::make('3291673465'),
            'address' => 'sadat city'
        ]);
    }
}
