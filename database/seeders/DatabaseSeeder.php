<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Issue;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@local.test',
        ], [
            'name' => 'Administrator',
            'password' => bcrypt('secret123'),
            'role' => 'admin',
        ]);

        User::firstOrCreate([
            'email' => 'user@local.test',
        ], [
            'name' => 'User Biasa',
            'password' => bcrypt('secret123'),
            'role' => 'user',
        ]);

        Issue::firstOrCreate(['name' => 'General'], ['description' => 'Laporan umum mengenai kegiatan perusahaan.']);
        Site::firstOrCreate(['name' => 'Head Office'], ['location' => 'Jakarta']);
    }
}
