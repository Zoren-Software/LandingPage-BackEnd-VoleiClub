<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL');

        User::updateOrCreate(
            ['email' => $adminEmail], // Se existir um usuário com esse e-mail, ele será atualizado
            [
                'name' => 'Administrator',
                'password' => Hash::make(env('ADMIN_PASSWORD')),
            ]
        );
    }
}
