<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'محمد أحمد',
                'email' => 'mohamed@example.com',
                'phone' => '0501234567',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'فاطمة علي',
                'email' => 'fatima@example.com',
                'phone' => '0501234568',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'أحمد محمود',
                'email' => 'ahmed@example.com',
                'phone' => '0501234569',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'نورة سعد',
                'email' => 'noura@example.com',
                'phone' => '0501234570',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'عبدالله خالد',
                'email' => 'abdullah@example.com',
                'phone' => '0501234571',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'سارة محمد',
                'email' => 'sara@example.com',
                'phone' => '0501234572',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'خالد عمر',
                'email' => 'khaled@example.com',
                'phone' => '0501234573',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'ريم سعيد',
                'email' => 'reem@example.com',
                'phone' => '0501234574',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'عمر فهد',
                'email' => 'omar@example.com',
                'phone' => '0501234575',
                'type' => 'user',
                'password' => 'password123',
            ],
            [
                'name' => 'منى علي',
                'email' => 'mona@example.com',
                'phone' => '0501234576',
                'type' => 'user',
                'password' => 'password123',
            ],
        ];

        foreach ($users as $user) {
            $user['password'] = Hash::make($user['password']);
            $user['email_verified_at'] = now();
            User::create($user);
        }
    }
}
