<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::factory()->create([
            'name' => 'user',
            'role' => 'user',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('component_types')->insert([
            ['name' => 'Motherboard', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Processor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'RAM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Casing', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Storage', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'VGA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'PSU', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Monitor', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        DB::table('clasifications')->insert([
            [
                'name' => 'Kebutuhan',
                'pertanyaan' => 'Apa kebutuhan untuk Anda?',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Budget',
                'pertanyaan' => 'Berapa budget yang Anda miliki?',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Processor Brand',
                'pertanyaan' => 'Berapa budget yang Anda miliki?',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        DB::table('categories')->insert([
            ['code' => 'NEED1', 'name' => 'Gaming', 'value' => 'gaming', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED2', 'name' => 'Office / Kerja Ringan', 'value' => 'office', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED3', 'name' => 'Desain Grafis', 'value' => 'design', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);


        DB::table('categories')->insert([
            // Budget per juta
            ['code' => 'BUD03', 'name' => 'Rp3 juta', 'value' => '3000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD04', 'name' => 'Rp4 juta', 'value' => '4000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD05', 'name' => 'Rp5 juta', 'value' => '5000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD06', 'name' => 'Rp6 juta', 'value' => '6000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD07', 'name' => 'Rp7 juta', 'value' => '7000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD08', 'name' => 'Rp8 juta', 'value' => '8000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD09', 'name' => 'Rp9 juta', 'value' => '9000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD10', 'name' => 'Rp10 juta', 'value' => '10000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD11', 'name' => 'Rp11 juta', 'value' => '11000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD12', 'name' => 'Rp12 juta', 'value' => '12000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD13', 'name' => 'Rp13 juta', 'value' => '13000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD14', 'name' => 'Rp14 juta', 'value' => '14000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD15', 'name' => 'Rp15 juta', 'value' => '15000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('categories')->insert([
            ['code' => 'CPU01', 'name' => 'Intel', 'value' => 'intel', 'clasification_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CPU02', 'name' => 'AMD', 'value' => 'amd', 'clasification_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::statement("
        INSERT INTO `components` (`id`, `name`, `code`, `description`, `component_type_id`, `price`, `is_active`, `created_at`, `updated_at`) VALUES
            (1, 'MSI A320M-A PRO', 'MB01', 'Mobo AMD A320, budget, AM4.', 1, 700000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (2, 'ASRock H610M-HDV', 'MB02', 'Mobo Intel H610, LGA1700, entry.', 1, 950000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (3, 'Gigabyte B450M DS3H', 'MB03', 'Mobo AMD B450, upgradable, AM4.', 1, 1200000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (4, 'Asus PRIME B660M-K', 'MB04', 'Mobo Intel B660, upgradable, LGA1700.', 1, 1500000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (5, 'AMD Athlon 3000G', 'CPU01', 'Dual Core, Vega 3 iGPU, irit, cocok office.', 2, 750000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (6, 'Intel Pentium Gold G6400', 'CPU02', 'Dual Core, UHD iGPU, irit listrik, office.', 2, 900000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (7, 'AMD Ryzen 3 4100', 'CPU03', '4C/8T, budget gaming/office.', 2, 1200000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (8, 'Intel Core i3-12100F', 'CPU04', '4C/8T, wajib VGA, gaming entry.', 2, 1550000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (9, 'AMD Ryzen 5 5600', 'CPU05', '6C/12T, gaming mid, editing.', 2, 2200000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (10, 'Intel Core i5-13400F', 'CPU06', '10C/16T, editing, gaming high.', 2, 2950000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (11, 'Kingston 4GB DDR4', 'RAM01', 'DDR4 4GB, office.', 3, 170000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (12, 'V-Gen 8GB DDR4', 'RAM02', 'DDR4 8GB, single stick.', 3, 300000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (13, 'Team Elite 16GB DDR4', 'RAM03', 'DDR4 16GB, dual channel.', 3, 650000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (14, 'Corsair 32GB DDR4', 'RAM04', 'DDR4 32GB, editing berat.', 3, 1450000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (15, 'ADATA SU650 120GB SSD', 'ST01', 'SSD 120GB, OS.', 5, 250000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (16, 'WD Green 240GB SSD', 'ST02', 'SSD 240GB, OS, app.', 5, 380000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (17, 'Seagate 1TB HDD', 'ST03', 'HDD 1TB, data.', 5, 550000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (18, 'Kingston NV1 500GB NVMe', 'ST04', 'NVMe 500GB, kencang.', 5, 600000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (19, 'Zotac GTX 1650 4GB', 'VGA01', 'GTX 1650, gaming entry.', 6, 2000000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (20, 'Sapphire RX 6600 8GB', 'VGA02', 'RX 6600, gaming/editing.', 6, 3500000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (21, 'RTX 3060 12GB', 'VGA03', 'RTX 3060, gaming/3D.', 6, 5200000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (22, 'SimVOLT 450W', 'PSU01', 'PSU 450W, entry.', 7, 240000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (23, 'Corsair CV550', 'PSU02', 'PSU 550W, gaming.', 7, 600000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (24, 'Seasonic 650W', 'PSU03', 'PSU 650W, high-end.', 7, 950000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (25, 'AOC 19.5 Inch', 'MON01', 'Monitor 20 Inch basic.', 8, 750000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (26, 'LG 24MK600', 'MON02', 'Monitor 24 Inch IPS.', 8, 1450000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (27, 'Infinity Neutron Mini', 'CAS01', 'Casing mini, entry.', 4, 180000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (28, 'Digital Alliance Nucleus', 'CAS02', 'Casing gaming, airflow.', 4, 350000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (29, 'Cube Gaming ARGB', 'CAS03', 'Casing mid, ARGB.', 4, 600000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43'),
            (30, 'Corsair 4000D', 'CAS04', 'Casing premium.', 4, 1450000.00, 1, '2025-06-24 01:44:43', '2025-06-24 01:44:43');
        ");

        DB::statement("
        INSERT INTO `rakitan` (`id`, `code`, `name`, `motherboard`, `processor`, `ram`, `casing`, `storage_primary`, `storage_secondary`, `vga`, `psu`, `monitor`, `created_by`, `created_at`, `updated_at`) VALUES
        (1, 'RKT001', 'Office Entry AMD - 3 Juta', 1, 5, 11, 27, 15, NULL, NULL, 22, 25, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
        (2, 'RKT002', 'Office Entry Intel - 3 Juta', 2, 6, 11, 27, 15, NULL, NULL, 22, 25, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
        (3, 'RKT003', 'Office Upgradable AMD - 4 Juta', 3, 5, 12, 28, 16, NULL, NULL, 22, 25, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
        (4, 'RKT004', 'Office Upgradable Intel - 4 Juta', 4, 6, 12, 28, 16, NULL, NULL, 22, 25, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
        (5, 'RKT005', 'Gaming Entry AMD - 7 Juta', 3, 7, 12, 28, 16, 17, 19, 23, 25, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
        (6, 'RKT006', 'Gaming Entry Intel - 8 Juta', 4, 8, 12, 28, 16, 18, 19, 23, 25, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
        (7, 'RKT007', 'Gaming Mid AMD - 12 Juta', 3, 9, 13, 30, 18, 17, 20, 24, 26, 1, '2025-06-24 02:16:14', '2025-06-24 02:15:42'),
        (8, 'RKT008', 'Editing Mid AMD - 12 Juta', 3, 9, 14, 29, 18, 16, 20, 24, 26, 1, '2025-06-24 02:16:14', '2025-06-24 02:15:55'),
        (9, 'RKT009', 'Gaming High Intel - 15 Juta', 4, 10, 13, 30, 18, 17, 21, 24, 26, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
        (10, 'RKT010', 'Editing/Desain High Intel - 16 Juta', 4, 10, 14, 30, 18, 16, 21, 24, 26, 1, '2025-06-24 02:16:14', '2025-06-24 02:16:14');
        ");

        DB::statement("
            INSERT INTO `rules` (`id`, `description`, `solusi`, `solusi_rekomendasi`, `description_rekomendasi`, `created_at`, `updated_at`) VALUES
            (1, 'PC Office Entry AMD cocok untuk kebutuhan harian, tugas kantor ringan, browsing, meeting online dengan konsumsi daya hemat dan harga terjangkau.', 1, 3, 'Jika ingin PC yang lebih mudah di-upgrade prosesor/ram, pilih \"Office Upgradable AMD - 4 Juta\".', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (2, 'PC Office Entry Intel sangat cocok untuk pekerjaan sekolah, administrasi, atau kasir dengan biaya terjangkau dan keandalan tinggi.', 2, 4, 'Jika ingin platform Intel dengan potensi upgrade lebih lama, pilih \"Office Upgradable Intel - 4 Juta\".', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (3, 'PC Office Upgradable AMD, bisa di-upgrade ke prosesor dan RAM lebih tinggi di masa depan, cocok kantor yang ingin aman investasi.', 3, 1, 'Jika budget terbatas, pilih \"Office Entry AMD - 3 Juta\".', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (4, 'PC Office Upgradable Intel, siap upgrade hingga Core i7/i9 dan RAM besar, cocok user kantor yang mau longevity.', 4, 2, 'Jika ingin lebih hemat, pilih \"Office Entry Intel - 3 Juta\".', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (5, 'PC Gaming Entry AMD – 7 Juta, cocok untuk gamer pemula yang ingin bermain e-sports dan game populer dengan pengaturan menengah. Kombinasi Ryzen 3 4100 dan GTX 1650 sudah cukup bertenaga.', 5, 7, 'Jika ingin main game AAA atau editing lebih lancar, pertimbangkan upgrade ke “Gaming Mid AMD – 12 Juta” dengan VGA RX 6600 dan RAM lebih besar.', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (6, 'PC Gaming Entry Intel – 8 Juta, ideal untuk gamer kasual dan streaming ringan. Core i3-12100F dan GTX 1650 mampu jalankan e-sports dan game populer lancar.', 6, 9, 'Jika ingin pengalaman gaming AAA dan editing lebih nyaman, pertimbangkan “Gaming High Intel – 15 Juta” dengan VGA RTX 3060 dan RAM besar.', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (7, 'PC Gaming Mid AMD – 12 Juta, sudah kuat untuk game AAA, editing video, dan multitasking, berkat Ryzen 5 5600, RX 6600, serta RAM 16GB.', 7, 8, 'Jika sering editing video, desain, dan butuh RAM besar, bisa upgrade ke “Editing Mid AMD – 12 Juta” yang sudah memakai RAM 32GB.', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (8, 'PC Editing Mid AMD – 12 Juta, siap kerja desain, editing video, serta gaming berat. Kombinasi Ryzen 5 5600, RX 6600, dan RAM 32GB sangat mendukung produktivitas.', 8, 10, 'Jika butuh performa maksimal dan gaming kelas atas, bisa upgrade ke “Editing/Desain High Intel – 16 Juta”.', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (9, 'PC Gaming High Intel – 15 Juta, sangat cocok untuk gaming AAA, streaming, dan pekerjaan berat dengan Core i5-13400F dan RTX 3060.', 9, 10, 'Jika pekerjaan utama adalah editing dan desain kelas profesional, pilih “Editing/Desain High Intel – 16 Juta” dengan RAM dan storage lebih lega.', '2025-06-24 02:16:14', '2025-06-24 02:16:14'),
            (10, 'PC Editing/Desain High Intel – 16 Juta, andalan untuk profesional editing, desain grafis, dan juga gaming berat. Kombinasi i5-13400F, RTX 3060, RAM 32GB, dan storage besar.', 10, 9, 'Jika ingin gaming berat namun dana ingin ditekan, “Gaming High Intel – 15 Juta” bisa jadi opsi terbaik.', '2025-06-24 02:16:14', '2025-06-24 02:16:14');
        ");

        DB::statement("
            INSERT INTO rule_categories (rule_id, category_id, created_at, updated_at) VALUES
                (10, 3, NULL, NULL),
                (10, 16, NULL, NULL),
                (10, 17, NULL, NULL),
                (9, 1, NULL, NULL),
                (9, 16, NULL, NULL),
                (9, 17, NULL, NULL),
                (8, 3, NULL, NULL),
                (8, 13, NULL, NULL),
                (8, 18, NULL, NULL),
                (7, 1, NULL, NULL),
                (7, 13, NULL, NULL),
                (7, 18, NULL, NULL),
                (5, 1, NULL, NULL),
                (5, 8, NULL, NULL),
                (5, 18, NULL, NULL),
                (6, 1, NULL, NULL),
                (6, 9, NULL, NULL),
                (6, 17, NULL, NULL),
                (3, 2, NULL, NULL),
                (3, 5, NULL, NULL),
                (3, 18, NULL, NULL),
                (4, 2, NULL, NULL),
                (4, 5, NULL, NULL),
                (4, 17, NULL, NULL),
                (2, 2, NULL, NULL),
                (2, 4, NULL, NULL),
                (2, 17, NULL, NULL),
                (1, 2, NULL, NULL),
                (1, 4, NULL, NULL),
                (1, 18, NULL, NULL);

        ");
    }
}
