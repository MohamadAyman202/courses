<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
           'name' => 'mohamad',
           'email' => 'mohamadayman2020@gmail.com',
           'password' => Hash::make('3291673465'),
           'phone' => '01007363331',
           'parent_phone' => '01117171519',
           'address' => 'sadate',
        ]);
    }
}
