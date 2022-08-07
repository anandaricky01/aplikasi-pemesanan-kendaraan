<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\User;
use App\Models\Role;
use App\Models\PendingKendaraan;
use App\Models\RiwayatKendaraan;
use App\Models\StatusKendaraan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Driver::factory(10)->create();
        // Kendaraan::factory(15)->create();
        // RiwayatKendaraan::factory(20)->create();
        
        StatusKendaraan::create([
            'status_kendaraan' => 'Tersedia'
        ]);

        StatusKendaraan::create([
            'status_kendaraan' => 'Digunakan'
        ]);

        StatusKendaraan::create([
            'status_kendaraan' => 'Perawatan'
        ]);

        Role::create([
            'role' => 'Admin'
        ]);

        Role::create([
            'role' => 'Atasan'
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role_id' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        User::create([
            'name' => 'Kasi Perhub',
            'email' => 'perhub@gmail.com',
            'role_id' => 2,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);
    }
}
