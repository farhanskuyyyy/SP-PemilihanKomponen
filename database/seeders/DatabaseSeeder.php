<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        \DB::table('component_types')->insert([
            ['name' => 'Motherboard', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Processor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'RAM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Casing', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Storage', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'VGA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'PSU', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Monitor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        \DB::table('components')->insert([
            [
                'name' => 'ASUS Prime B450M',
                'code' => 'MB001',
                'price' => 1200000,
                'description' => 'Motherboard untuk AMD Ryzen',
                'component_type_id' => 1,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Intel Core i5 10400F',
                'code' => 'CPU001',
                'price' => 2200000,
                'description' => 'Processor Intel generasi ke-10',
                'component_type_id' => 2,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Corsair Vengeance 8GB',
                'code' => 'RAM001',
                'price' => 600000,
                'description' => 'RAM DDR4 8GB',
                'component_type_id' => 3,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'NZXT H510',
                'code' => 'CAS001',
                'price' => 900000,
                'description' => 'Casing Mid Tower',
                'component_type_id' => 4,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Samsung 970 EVO 500GB',
                'code' => 'STG001',
                'price' => 1200000,
                'description' => 'SSD NVMe 500GB',
                'component_type_id' => 5,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'WD Blue 1TB',
                'code' => 'STG002',
                'price' => 700000,
                'description' => 'HDD 1TB',
                'component_type_id' => 5,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'MSI GTX 1660',
                'code' => 'VGA001',
                'price' => 3500000,
                'description' => 'VGA NVIDIA GTX 1660',
                'component_type_id' => 6,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Corsair CX550',
                'code' => 'PSU001',
                'price' => 800000,
                'description' => 'PSU 550W',
                'component_type_id' => 7,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'LG 24MK600',
                'code' => 'MON001',
                'price' => 1500000,
                'description' => 'Monitor 24 inch IPS',
                'component_type_id' => 8,
                'is_active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        \DB::table('rakitan')->insert([
            [
                'code' => 'R1',
                'name' => 'Rakitan Gaming',
                'motherboard' => 1,
                'processor' => 2,
                'ram' => 3,
                'casing' => 4,
                'storage_primary' => 5,
                'storage_secondary' => 6,
                'vga' => 7,
                'psu' => 8,
                'monitor' => 9,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        \DB::table('clasifications')->insert([
            [
                'name' => 'Performa',
                'pertanyaan' => 'Seberapa penting performa untuk Anda?',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Budget',
                'pertanyaan' => 'Berapa budget yang Anda miliki?',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        \DB::table('categories')->insert([
            [
                'code' => 'PERF1',
                'name' => 'High Performance',
                'value' => 'high',
                'clasification_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'PERF2',
                'name' => 'Standard Performance',
                'value' => 'standard',
                'clasification_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'BUD1',
                'name' => 'Budget',
                'value' => 'low',
                'clasification_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'BUD2',
                'name' => 'Midrange',
                'value' => 'medium',
                'clasification_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'BUD3',
                'name' => 'High End',
                'value' => 'high',
                'clasification_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
