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

        // DB::statement("
        //     INSERT INTO components (name, code, description, component_type_id, price, is_active, created_at, updated_at) VALUES('ASUS Prime B450M', 'MB001', 'Motherboard untuk AMD Ryzen', 1, 1200000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('Intel Core i5 10400F', 'CPU001', 'Processor Intel generasi ke-10', 2, 2200000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('Corsair Vengeance 8GB', 'RAM001', 'RAM DDR4 8GB', 3, 600000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('NZXT H510', 'CAS001', 'Casing Mid Tower', 4, 900000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('Samsung 970 EVO 500GB', 'STG001', 'SSD NVMe 500GB', 5, 1200000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('WD Blue 1TB', 'STG002', 'HDD 1TB', 5, 700000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('MSI GTX 1660', 'VGA001', 'VGA NVIDIA GTX 1660', 6, 3500000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('Corsair CX550', 'PSU001', 'PSU 550W', 7, 800000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('LG 24MK600', 'MON001', 'Monitor 24 inch IPS', 8, 1500000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
        //     ,('MSI B460M PRO-VDH', 'MB002', 'Motherboard untuk Intel 10th Gen', 1, 1100000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Gigabyte B550M DS3H', 'MB003', 'B550 chipset motherboard AMD', 1, 1350000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('ASRock A320M-HDV R4.0', 'MB004', 'Budget motherboard untuk Ryzen', 1, 850000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('ASUS TUF Gaming B660M', 'MB005', 'Motherboard untuk Intel Gen 12', 1, 1650000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('AMD Ryzen 5 3600', 'CPU002', '6-Core 12-Thread Processor', 2, 2300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Intel Core i3 12100F', 'CPU003', 'Quad-core processor', 2, 1800000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('AMD Ryzen 7 5700G', 'CPU004', 'APU dengan Vega Graphics', 2, 2900000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Intel Core i7 10700K', 'CPU005', '8-core processor untuk gaming', 2, 3700000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('G.SKILL Ripjaws V 16GB', 'RAM002', 'DDR4 3200MHz Dual Channel', 3, 1150000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Kingston Fury Beast 8GB', 'RAM003', 'DDR4 3200MHz CL16', 3, 620000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Team Elite Plus 4GB', 'RAM004', 'DDR4 2666MHz RAM', 3, 300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Corsair Dominator 32GB', 'RAM005', 'High-end DDR4 memory', 3, 2200000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Cooler Master NR400', 'CAS002', 'Micro-ATX case dengan airflow', 4, 800000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Deepcool MATREXX 30', 'CAS003', 'Budget Micro-ATX case', 4, 450000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Lian Li PC-O11 Dynamic', 'CAS004', 'Premium casing dual chamber', 4, 1700000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Aerocool Bolt Mini', 'CAS005', 'Mini Tower stylish casing', 4, 350000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Kingston A2000 1TB', 'STG003', 'NVMe SSD 1TB', 5, 1350000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Seagate Barracuda 2TB', 'STG004', 'HDD 2TB', 5, 950000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Crucial MX500 500GB', 'STG005', 'SATA SSD 500GB', 5, 1000000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('ASUS RTX 3060', 'VGA002', 'VGA NVIDIA RTX 3060', 6, 5000000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Gigabyte RX 6600 XT', 'VGA003', 'VGA AMD RX 6600 XT', 6, 4800000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Zotac GTX 1650', 'VGA004', 'Entry-level gaming GPU', 6, 2600000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('PowerColor RX 580 8GB', 'VGA005', 'Mid-range AMD VGA', 6, 2000000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Seasonic S12III 650W', 'PSU002', 'PSU 80+ Bronze', 7, 950000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('FSP Hexa+ 500W', 'PSU003', 'Budget PSU', 7, 550000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Thermaltake Smart RGB 600W', 'PSU004', 'PSU dengan RGB Fan', 7, 700000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Cooler Master MWE 450W', 'PSU005', 'Entry-level PSU', 7, 600000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('AOC 24G2E', 'MON002', '144Hz Gaming Monitor', 8, 1900000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('ASUS VG249Q', 'MON003', '24 Inch 144Hz IPS monitor', 8, 2300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('Samsung S24R350', 'MON004', 'Monitor 24 Inch Full HD', 8, 1400000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('BenQ GW2480', 'MON005', 'Monitor IPS Eye-Care 24 Inch', 8, 1300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
        //     ,('ASRock B550M Steel Legend', 'MB006', 'Solid B550 motherboard for AMD', 1, 950000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Gigabyte A520M S2H', 'MB007', 'Entry-level AM4 motherboard', 1, 1600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('ASUS ROG Strix B460-F', 'MB008', 'Gaming motherboard for Intel', 1, 1700000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('MSI MAG B660M Mortar', 'MB009', 'High-performance Intel mATX board', 1, 750000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Biostar A320MH', 'MB010', 'Budget AM4 board', 1, 900000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Intel Pentium G6400', 'CPU006', 'Entry-level Intel dual-core CPU', 2, 750000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('AMD Athlon 3000G', 'CPU007', 'Budget AMD APU', 2, 5200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Intel Core i9 10900K', 'CPU008', 'High-end Intel 10th Gen CPU', 2, 6300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('AMD Ryzen 9 5900X', 'CPU009', '12-core powerhouse CPU', 2, 2300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Intel Core i5 11400', 'CPU010', 'Mid-range Intel CPU', 2, 620000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('ADATA XPG Gammix D30 8GB', 'RAM006', 'DDR4 3200MHz RAM', 3, 1250000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Patriot Viper 4 Blackout 16GB', 'RAM007', 'DDR4 high-performance RAM', 3, 580000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Silicon Power 8GB DDR4', 'RAM008', 'Budget DDR4 RAM', 3, 1600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('G.Skill Trident Z RGB 16GB', 'RAM009', 'RGB high-speed RAM', 3, 1100000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Team T-Force Vulcan Z 16GB', 'RAM010', 'Performance DDR4 RAM', 3, 950000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Fractal Design Focus G', 'CAS006', 'ATX case with tempered glass', 4, 700000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('SilverStone Fara R1', 'CAS007', 'Compact ATX case', 4, 650000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Cooler Master MasterBox Q300L', 'CAS008', 'Versatile Micro-ATX case', 4, 1200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Phanteks Eclipse P400A', 'CAS009', 'High airflow ATX case', 4, 600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Antec NX210', 'CAS010', 'Gaming-oriented ATX case', 4, 400000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('ADATA SU650 240GB', 'STG006', 'SATA SSD for everyday use', 5, 1800000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Seagate FireCuda 510 1TB', 'STG007', 'High-performance NVMe SSD', 5, 720000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Toshiba P300 1TB', 'STG008', 'Reliable desktop HDD', 5, 1250000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Kingston KC2500 500GB', 'STG009', 'NVMe SSD with fast speeds', 5, 480000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Patriot P300 256GB', 'STG010', 'Affordable NVMe SSD', 5, 3400000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('NVIDIA Quadro P620', 'VGA006', 'Entry-level professional GPU', 6, 2800000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('ASUS TUF GTX 1650 Super', 'VGA007', 'Great value gaming GPU', 6, 4300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Gigabyte RTX 3050', 'VGA008', 'New gen RTX GPU', 6, 1900000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('PowerColor RX 570 4GB', 'VGA009', 'Good budget gaming GPU', 6, 4200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Zotac RTX 2060', 'VGA010', 'Mid-range RTX GPU', 6, 850000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Be Quiet! System Power 9 500W', 'PSU006', 'Efficient and quiet PSU', 7, 750000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('EVGA 600 BR', 'PSU007', 'Reliable PSU for budget build', 7, 1200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Seasonic Focus GX-550', 'PSU008', 'Gold-rated PSU', 7, 1300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Corsair RM650', 'PSU009', 'Fully modular 650W PSU', 7, 600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Thermaltake Smart 500W', 'PSU010', 'Entry-level PSU', 7, 2100000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('MSI Optix G241', 'MON006', '144Hz IPS Gaming Monitor', 8, 1200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Philips 243V7QDSB', 'MON007', 'Full HD IPS monitor', 8, 1250000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Lenovo D24-20', 'MON008', '24-inch VA monitor', 8, 1350000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('ViewSonic VA2456-MHD', 'MON009', 'Business IPS Monitor', 8, 1600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('Acer Nitro VG240Y', 'MON010', 'Gaming IPS 75Hz Monitor', 8, 1.60, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('ASUS TUF Gaming B550-PLUS', 'MB011', 'Durable AM4 motherboard', 1, 1700000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
        //     ,('MSI Pro B660M-A DDR4', 'MB012', 'Intel 12th Gen ready motherboard', 1, 1500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Gigabyte Z690 AORUS ELITE AX', 'MB013', 'High-end Intel Z690 chipset', 1, 3200000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Biostar H510MHP', 'MB014', 'Entry Intel 10th Gen mobo', 1, 850000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('AMD Ryzen 5 5600X', 'CPU011', '6-core CPU with high efficiency', 2, 2800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Intel Core i7 12700KF', 'CPU012', 'Alder Lake beast processor', 2, 5600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('AMD Ryzen 7 5800X3D', 'CPU013', 'Gaming-focused 3D cache CPU', 2, 4900000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Kingston Fury Beast 8GB DDR5', 'RAM011', 'High-speed DDR5 RAM', 3, 1500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('G.Skill Ripjaws V 8GB DDR4', 'RAM012', 'Reliable DDR4 performance RAM', 3, 620000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('ADATA XPG Lancer RGB 16GB', 'RAM013', 'DDR5 RAM with RGB for gaming', 3, 2100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Thermaltake Versa H17', 'CAS011', 'Compact micro-ATX case', 4, 500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Deepcool Matrexx 55', 'CAS012', 'Tempered glass case', 4, 950000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Lian Li LANCOOL 215', 'CAS013', 'Airflow-focused tower', 4, 1100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Samsung 980 Pro 1TB', 'STG011', 'PCIe 4.0 ultra-fast SSD', 5, 2300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Crucial BX500 480GB', 'STG012', 'Budget SATA SSD', 5, 600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('WD Black SN850 500GB', 'STG013', 'Gaming NVMe SSD', 5, 1800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('MSI RTX 3060 Ti Ventus', 'VGA011', 'Ray tracing GPU with DLSS', 6, 6300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('PowerColor RX 6600 XT', 'VGA012', 'Mid-range GPU from AMD', 6, 4600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('ASUS ROG Strix RTX 3070 OC', 'VGA013', 'Powerful 1440p gaming GPU', 6, 9000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('FSP Hyper K 600W', 'PSU011', 'Budget 600W PSU', 7, 650000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Cooler Master MWE 650 Bronze', 'PSU012', 'Semi-modular Bronze certified PSU', 7, 850000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('DeepCool DN500', 'PSU013', 'Entry-level PSU', 7, 500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('LG 27GN750-B', 'MON011', '240Hz esports-grade monitor', 8, 4800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('ViewSonic XG2405', 'MON012', 'Fast IPS gaming monitor', 8, 2900000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('AOC C24G1', 'MON013', 'Curved 144Hz gaming monitor', 8, 2300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Intel Arc A770 16GB', 'VGA014', 'Intel''s high-performance gaming GPU', 6, 5000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('ASUS Dual RTX 4060 OC', 'VGA015', 'Latest generation RTX GPU', 6, 5500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('MSI MEG Z790 ACE', 'MB015', 'Flagship Intel Z790 motherboard', 1, 8000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Intel Core i3 12100F', 'CPU014', 'Budget 12th Gen Intel processor', 2, 1500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('AMD Ryzen 3 4100', 'CPU015', 'Affordable 4-core CPU', 2, 1100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('G.Skill Flare X 8GB DDR4', 'RAM014', 'AMD-optimized RAM', 3, 640000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Lexar NM610 500GB', 'STG014', 'Entry-level NVMe SSD', 5, 720000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Transcend 820S 240GB', 'STG015', 'Budget SATA SSD', 5, 420000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Thermaltake Toughpower 750W', 'PSU014', 'High-capacity PSU for gaming builds', 7, 1350000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('ASUS VG259Q', 'MON014', '144Hz gaming IPS display', 8, 2800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('MSI Optix MAG274QRF-QD', 'MON015', '165Hz QHD gaming monitor', 8, 5500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Cougar MX330', 'CAS014', 'Mid-tower case with mesh front', 4, 650000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Montech Air 100 ARGB', 'CAS015', 'Airflow-focused with RGB', 4, 850000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Biostar A68N-5600', 'MB016', 'Motherboard with built-in APU', 1, 950000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('HP EX900 1TB', 'STG016', 'Fast and reliable NVMe SSD', 5, 1750000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Seagate Barracuda 2TB', 'STG017', 'High-capacity HDD', 5, 1050000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('GALAX RTX 3080 SG', 'VGA016', 'High-end gaming GPU', 6, 12000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('AMD Radeon RX 6750 XT', 'VGA017', 'Strong 1440p performance GPU', 6, 6500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('FSP Hydro GT 750W', 'PSU015', 'Gold-certified modular PSU', 7, 1550000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Thermaltake V250 TG ARGB', 'CAS016', 'RGB mid-tower ATX case', 4, 1100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Acer Nitro VG270', 'MON016', '27-inch gaming IPS screen', 8, 2600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('ASRock A320M-HDV', 'MB017', 'Value AM4 motherboard', 1, 780000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Intel Xeon E-2236', 'CPU016', 'Workstation CPU', 2, 3600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Transcend JetRAM 8GB', 'RAM015', 'Basic DDR4 RAM', 3, 590000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Patriot Burst Elite 240GB', 'STG018', 'Affordable SSD for boot drive', 5, 410000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('SilverStone ST50F-ES230 500W', 'PSU016', 'Entry-level PSU from SilverStone', 7, 580000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Dell S2721DGF', 'MON017', '165Hz QHD professional gaming monitor', 8, 6000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('ASUS ProArt B550-Creator', 'MB018', 'Professional AMD motherboard', 1, 3400000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Corsair Vengeance RGB RS 16GB', 'RAM016', 'DDR4 with vibrant RGB', 3, 1300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('WD Green 240GB SATA', 'STG019', 'Basic SSD for everyday use', 5, 400000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Inno3D GTX 1050 Ti', 'VGA018', 'Entry gaming GPU', 6, 1600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
        //     ,('Palit RTX 4060 Dual', 'VGA019', 'Budget-friendly RTX 4060', 6, 4900000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0');
        // ");

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
            ['code' => 'NEED3', 'name' => 'Editing Video & Rendering', 'value' => 'editing', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED4', 'name' => 'Server / Virtualisasi', 'value' => 'server', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED5', 'name' => 'Desain Grafis', 'value' => 'design', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);


        DB::table('categories')->insert([
            // Budget per juta
            ['code' => 'BUD01', 'name' => 'Rp1 juta', 'value' => '1000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'BUD02', 'name' => 'Rp2 juta', 'value' => '2000000', 'clasification_id' => 2, 'created_at' => now(), 'updated_at' => now()],
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

        // Seeder untuk tabel components (id auto increment dari 1)
        DB::table('components')->insert([
            // Motherboard (1-6)
            ['name' => 'Asus Prime H510M-E', 'code' => 'MB01', 'price' => 900000, 'description' => 'Motherboard Intel H510, micro ATX, support Gen 10/11, RAM max 64GB.', 'component_type_id' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MSI B450M-A PRO MAX', 'code' => 'MB02', 'price' => 950000, 'description' => 'Motherboard AMD B450, micro ATX, support Ryzen 1st-3rd, RAM max 64GB.', 'component_type_id' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asus TUF B660M-PLUS', 'code' => 'MB03', 'price' => 1850000, 'description' => 'Motherboard Intel B660, DDR4, support Gen 12/13, PCIe 4.0, gaming.', 'component_type_id' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gigabyte B550M DS3H', 'code' => 'MB04', 'price' => 1750000, 'description' => 'Motherboard AMD B550, DDR4, PCIe 4.0, upgradable hingga Ryzen 9.', 'component_type_id' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ASRock H610M-HDV/M.2', 'code' => 'MB05', 'price' => 1150000, 'description' => 'Motherboard Intel H610, DDR4, LGA1700, budget entry.', 'component_type_id' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ASUS X570-PRO', 'code' => 'MB06', 'price' => 3250000, 'description' => 'Motherboard AMD X570, ATX, support Ryzen high-end, PCIe 4.0, futureproof.', 'component_type_id' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Processor (7-13)
            ['name' => 'Intel Pentium Gold G6400', 'code' => 'CPU01', 'price' => 850000, 'description' => 'Dual Core, 2 Thread, TDP 58W. Cocok kebutuhan office.', 'component_type_id' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AMD Athlon 3000G', 'code' => 'CPU02', 'price' => 750000, 'description' => 'Dual Core, 4 Thread, Vega 3, hemat listrik, office ringan.', 'component_type_id' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Intel Core i3-12100F', 'code' => 'CPU03', 'price' => 1550000, 'description' => 'Quad Core, 8 Thread, kencang untuk office, gaming e-sport.', 'component_type_id' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AMD Ryzen 3 4100', 'code' => 'CPU04', 'price' => 1200000, 'description' => '4C/8T, cukup kuat untuk gaming ringan, editing entry.', 'component_type_id' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Intel Core i5-13400F', 'code' => 'CPU05', 'price' => 2900000, 'description' => '10C/16T, sangat baik untuk gaming dan produktivitas.', 'component_type_id' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AMD Ryzen 5 5600', 'code' => 'CPU06', 'price' => 2200000, 'description' => '6C/12T, kencang untuk editing dan multitasking.', 'component_type_id' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AMD Ryzen 7 5700X', 'code' => 'CPU07', 'price' => 3900000, 'description' => '8C/16T, unggul untuk rendering, desain, gaming berat.', 'component_type_id' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            // RAM (14-17)
            ['name' => 'V-Gen 8GB DDR4 2666', 'code' => 'RAM01', 'price' => 300000, 'description' => 'Single stick, basic usage, upgradable.', 'component_type_id' => 3, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Team Elite 16GB (2x8GB) DDR4 3200', 'code' => 'RAM02', 'price' => 650000, 'description' => 'Dual channel, gaming, editing optimal.', 'component_type_id' => 3, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corsair Vengeance 32GB (2x16GB) DDR4 3600', 'code' => 'RAM03', 'price' => 1450000, 'description' => 'High performance, untuk server, rendering, multitasking berat.', 'component_type_id' => 3, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kingston 4GB DDR4 2400', 'code' => 'RAM04', 'price' => 170000, 'description' => 'Paling basic, cocok ultra low budget.', 'component_type_id' => 3, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Casing (18-21)
            ['name' => 'Infinity Neutron Mini', 'code' => 'CAS01', 'price' => 180000, 'description' => 'Mini ATX, low budget.', 'component_type_id' => 4, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Digital Alliance Nucleus', 'code' => 'CAS02', 'price' => 350000, 'description' => 'Airflow baik, budget gaming.', 'component_type_id' => 4, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cube Gaming LED ARGB', 'code' => 'CAS03', 'price' => 600000, 'description' => 'ARGB, airflow optimal, mid-range.', 'component_type_id' => 4, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corsair 4000D Airflow', 'code' => 'CAS04', 'price' => 1450000, 'description' => 'Casing premium, airflow & ekspansi optimal.', 'component_type_id' => 4, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Storage (22-27)
            ['name' => 'WD Green 240GB SSD', 'code' => 'ST01', 'price' => 380000, 'description' => 'SSD basic untuk OS & apps.', 'component_type_id' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Seagate Barracuda 1TB HDD', 'code' => 'ST02', 'price' => 550000, 'description' => 'Penyimpanan data besar, HDD 7200rpm.', 'component_type_id' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kingston NV1 500GB NVMe', 'code' => 'ST03', 'price' => 600000, 'description' => 'SSD NVMe, performa tinggi.', 'component_type_id' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'WD Black SN850X 1TB NVMe', 'code' => 'ST04', 'price' => 1850000, 'description' => 'SSD high-end, cocok editing/rendering.', 'component_type_id' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ADATA SU650 120GB SSD', 'code' => 'ST05', 'price' => 250000, 'description' => 'SSD entry, cocok office.', 'component_type_id' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toshiba 2TB HDD', 'code' => 'ST06', 'price' => 900000, 'description' => 'HDD kapasitas besar, server/storage.', 'component_type_id' => 5, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            // VGA (28-32)
            ['name' => 'Zotac GTX 1650 4GB', 'code' => 'VGA01', 'price' => 2000000, 'description' => 'VGA gaming entry, hemat daya.', 'component_type_id' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sapphire RX 6600 8GB', 'code' => 'VGA02', 'price' => 3500000, 'description' => 'VGA mid-high, editing/rendering lancar.', 'component_type_id' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'RTX 3060 12GB', 'code' => 'VGA03', 'price' => 5200000, 'description' => 'VGA high-end, cocok AAA gaming, desain 3D.', 'component_type_id' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AMD Radeon Vega 8 (iGPU)', 'code' => 'VGA04', 'price' => 0, 'description' => 'iGPU, hanya tersedia pada beberapa Ryzen, tanpa discrete VGA.', 'component_type_id' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Intel UHD Graphics 610 (iGPU)', 'code' => 'VGA05', 'price' => 0, 'description' => 'iGPU, hanya pada Pentium/Intel non-F, hanya office/browsing.', 'component_type_id' => 6, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            // PSU (33-36)
            ['name' => 'SimVOLT 450W', 'code' => 'PSU01', 'price' => 240000, 'description' => 'PSU basic, non-modular, cukup untuk rakitan entry.', 'component_type_id' => 7, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Corsair CV550 550W', 'code' => 'PSU02', 'price' => 600000, 'description' => '550W, cocok gaming/editing.', 'component_type_id' => 7, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Seasonic S12III 650W', 'code' => 'PSU03', 'price' => 950000, 'description' => '650W, kualitas premium, aman overclock.', 'component_type_id' => 7, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'FSP Hydro G Pro 850W', 'code' => 'PSU04', 'price' => 1700000, 'description' => '850W, untuk rakitan high end/server.', 'component_type_id' => 7, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Monitor (37-40)
            ['name' => 'AOC 19.5" E2070SWNE', 'code' => 'MON01', 'price' => 750000, 'description' => 'Monitor 20 inch, panel TN.', 'component_type_id' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'LG 24MK600', 'code' => 'MON02', 'price' => 1450000, 'description' => 'Monitor 24 inch IPS, FullHD, low input lag.', 'component_type_id' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MSI Optix G24C4', 'code' => 'MON03', 'price' => 2150000, 'description' => 'Monitor 24 inch curved, 144Hz, cocok gaming.', 'component_type_id' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dell S2721QS', 'code' => 'MON04', 'price' => 4300000, 'description' => 'Monitor 27 inch, 4K UHD, untuk editing/desain profesional.', 'component_type_id' => 8, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('rakitan')->insert([
            // Rakitan Office Low Budget - Intel
            ['code' => 'RKT001', 'name' => 'Office Entry Intel 2 Juta', 'motherboard' => 5, 'processor' => 7, 'ram' => 17, 'casing' => 18, 'storage_primary' => 26, 'storage_secondary' => null, 'vga' => 31, 'psu' => 33, 'monitor' => 37, 'created_by' => 1],
            // Office Entry AMD
            ['code' => 'RKT002', 'name' => 'Office Entry AMD 2 Juta', 'motherboard' => 2, 'processor' => 8, 'ram' => 17, 'casing' => 18, 'storage_primary' => 26, 'storage_secondary' => null, 'vga' => 31, 'psu' => 33, 'monitor' => 37, 'created_by' => 1],
            // Office Upgradable Intel
            ['code' => 'RKT003', 'name' => 'Office Futureproof Intel 4 Juta', 'motherboard' => 3, 'processor' => 7, 'ram' => 14, 'casing' => 18, 'storage_primary' => 22, 'storage_secondary' => null, 'vga' => 31, 'psu' => 33, 'monitor' => 37, 'created_by' => 1],
            // Gaming Hemat Intel
            ['code' => 'RKT004', 'name' => 'Gaming Hemat Intel 5 Juta', 'motherboard' => 5, 'processor' => 9, 'ram' => 14, 'casing' => 19, 'storage_primary' => 22, 'storage_secondary' => 23, 'vga' => 28, 'psu' => 34, 'monitor' => 37, 'created_by' => 1],
            // Gaming Hemat AMD
            ['code' => 'RKT005', 'name' => 'Gaming Hemat AMD 5 Juta', 'motherboard' => 2, 'processor' => 10, 'ram' => 14, 'casing' => 19, 'storage_primary' => 22, 'storage_secondary' => 23, 'vga' => 28, 'psu' => 34, 'monitor' => 37, 'created_by' => 1],
            // Gaming Mid Intel
            ['code' => 'RKT006', 'name' => 'Gaming Mid Intel 9 Juta', 'motherboard' => 3, 'processor' => 11, 'ram' => 15, 'casing' => 20, 'storage_primary' => 24, 'storage_secondary' => 23, 'vga' => 29, 'psu' => 34, 'monitor' => 38, 'created_by' => 1],
            // Gaming Mid AMD
            ['code' => 'RKT007', 'name' => 'Gaming Mid AMD 9 Juta', 'motherboard' => 4, 'processor' => 12, 'ram' => 15, 'casing' => 20, 'storage_primary' => 24, 'storage_secondary' => 23, 'vga' => 29, 'psu' => 34, 'monitor' => 38, 'created_by' => 1],
            // Gaming High Intel
            ['code' => 'RKT008', 'name' => 'Gaming High Intel 14 Juta', 'motherboard' => 3, 'processor' => 11, 'ram' => 16, 'casing' => 21, 'storage_primary' => 25, 'storage_secondary' => 24, 'vga' => 30, 'psu' => 35, 'monitor' => 39, 'created_by' => 1],
            // Gaming High AMD
            ['code' => 'RKT009', 'name' => 'Gaming High AMD 14 Juta', 'motherboard' => 6, 'processor' => 13, 'ram' => 16, 'casing' => 21, 'storage_primary' => 25, 'storage_secondary' => 24, 'vga' => 30, 'psu' => 36, 'monitor' => 39, 'created_by' => 1],
            // Editing/Desain Budget AMD
            ['code' => 'RKT010', 'name' => 'Editing Budget AMD 8 Juta', 'motherboard' => 4, 'processor' => 12, 'ram' => 15, 'casing' => 20, 'storage_primary' => 24, 'storage_secondary' => 23, 'vga' => 29, 'psu' => 34, 'monitor' => 38, 'created_by' => 1],
            // Editing/Desain Mid Intel
            ['code' => 'RKT011', 'name' => 'Editing Mid Intel 12 Juta', 'motherboard' => 3, 'processor' => 11, 'ram' => 16, 'casing' => 21, 'storage_primary' => 24, 'storage_secondary' => 23, 'vga' => 30, 'psu' => 35, 'monitor' => 39, 'created_by' => 1],
            // Server/Virtualisasi Budget
            ['code' => 'RKT012', 'name' => 'Server Entry AMD 6 Juta', 'motherboard' => 2, 'processor' => 12, 'ram' => 15, 'casing' => 20, 'storage_primary' => 23, 'storage_secondary' => 27, 'vga' => 31, 'psu' => 35, 'monitor' => 37, 'created_by' => 1],
            // Server High End
            ['code' => 'RKT013', 'name' => 'Server High End AMD 15 Juta', 'motherboard' => 6, 'processor' => 13, 'ram' => 16, 'casing' => 21, 'storage_primary' => 25, 'storage_secondary' => 27, 'vga' => 31, 'psu' => 36, 'monitor' => 40, 'created_by' => 1],
        ]);

        DB::table('rules')->insert([
            // Office 2 juta Intel, solusi rekomendasi: Office upgradable (RKT003)
            [
                'description' => 'Solusi PC office murah 2 juta, cukup untuk kebutuhan mengetik, browsing, dan meeting online. Komponen low budget.',
                'solusi' => 1,
                'solusi_rekomendasi' => 3,
                'description_rekomendasi' => 'Jika kamu ingin upgrade di masa depan, pilih rakitan Office Futureproof (RKT003) karena sudah menggunakan motherboard dan RAM yang mendukung prosesor generasi baru dan ekspansi RAM hingga 64GB.'
            ],
            // Office 2 juta AMD, solusi rekomendasi: Office upgradable (RKT003)
            [
                'description' => 'Solusi PC office murah 2 juta, cukup untuk kebutuhan dasar, sangat hemat listrik dan efisien.',
                'solusi' => 2,
                'solusi_rekomendasi' => 3,
                'description_rekomendasi' => 'Jika ingin meningkatkan kinerja dan kompatibilitas, rakitan Office Futureproof (RKT003) dapat menjadi pilihan agar mudah di-upgrade tanpa harus mengganti motherboard.'
            ],
            // Office futureproof (RKT003), rekomendasi downgrade: RKT001
            [
                'description' => 'Solusi PC office 4 juta, sudah futureproof dan siap untuk upgrade jangka panjang.',
                'solusi' => 3,
                'solusi_rekomendasi' => 1,
                'description_rekomendasi' => 'Jika kamu memiliki budget terbatas, pilih rakitan Office Entry (RKT001) agar tetap bisa memenuhi kebutuhan dasar, namun fitur upgrade terbatas.'
            ],
            // Gaming hemat Intel (RKT004), rekomendasi upgrade: Gaming Mid Intel (RKT006)
            [
                'description' => 'PC gaming hemat 5 juta, bisa menjalankan game e-sports dan tugas multimedia ringan.',
                'solusi' => 4,
                'solusi_rekomendasi' => 6,
                'description_rekomendasi' => 'Jika ingin performa lebih untuk gaming dan editing, pilih Gaming Mid Intel (RKT006) yang sudah memakai VGA lebih kuat, RAM dual channel dan storage lebih cepat.'
            ],
            // Gaming hemat AMD (RKT005), upgrade: Gaming Mid AMD (RKT007)
            [
                'description' => 'PC gaming hemat 5 juta berbasis AMD, cocok untuk game e-sports dan tugas harian.',
                'solusi' => 5,
                'solusi_rekomendasi' => 7,
                'description_rekomendasi' => 'Jika kamu memiliki budget lebih, pilih Gaming Mid AMD (RKT007) untuk performa gaming lebih tinggi dan lebih futureproof untuk upgrade selanjutnya.'
            ],
            // Gaming Mid Intel (RKT006), upgrade: Gaming High Intel (RKT008)
            [
                'description' => 'PC gaming menengah 9 juta, sudah sangat ideal untuk game berat, multitasking, dan editing ringan.',
                'solusi' => 6,
                'solusi_rekomendasi' => 8,
                'description_rekomendasi' => 'Jika kamu ingin pengalaman gaming AAA dengan setting ultra dan editing lebih lancar, pilih Gaming High Intel (RKT008) dengan VGA dan RAM lebih besar.'
            ],
            // Gaming Mid AMD (RKT007), upgrade: Gaming High AMD (RKT009)
            [
                'description' => 'PC gaming menengah 9 juta berbasis AMD, siap untuk game AAA dan editing video.',
                'solusi' => 7,
                'solusi_rekomendasi' => 9,
                'description_rekomendasi' => 'Jika kamu menginginkan performa lebih untuk desain grafis dan rendering, pilih Gaming High AMD (RKT009) karena motherboard dan PSU sudah support upgrade komponen high-end.'
            ],
            // Gaming High Intel (RKT008), rekomendasi downgrade: Gaming Mid Intel (RKT006)
            [
                'description' => 'PC gaming high-end 14 juta, optimal untuk gaming berat, editing, dan pekerjaan kreatif.',
                'solusi' => 8,
                'solusi_rekomendasi' => 6,
                'description_rekomendasi' => 'Jika ingin menekan budget tanpa kehilangan banyak performa, pilih Gaming Mid Intel (RKT006) yang masih mumpuni untuk gaming dan editing, meskipun tanpa fitur ekstra pada rakitan high-end.'
            ],
            // Gaming High AMD (RKT009), rekomendasi downgrade: Gaming Mid AMD (RKT007)
            [
                'description' => 'PC gaming high-end AMD 14 juta, siap untuk rendering, 3D design, dan gaming ekstrem.',
                'solusi' => 9,
                'solusi_rekomendasi' => 7,
                'description_rekomendasi' => 'Jika kamu ingin harga lebih bersahabat namun tetap bisa menikmati gaming dan editing lancar, pilih Gaming Mid AMD (RKT007) yang masih sangat layak digunakan.'
            ],
            // Editing Budget AMD (RKT010), rekomendasi upgrade: Editing Mid Intel (RKT011)
            [
                'description' => 'PC editing dan desain 8 juta, RAM dan SSD besar, VGA cukup kuat untuk Adobe suite.',
                'solusi' => 10,
                'solusi_rekomendasi' => 11,
                'description_rekomendasi' => 'Jika kamu sering melakukan editing video dan butuh performa lebih, pilih Editing Mid Intel (RKT011) karena sudah menggunakan VGA dan RAM kelas atas serta monitor 24 inch.'
            ],
            // Editing Mid Intel (RKT011), downgrade: Editing Budget AMD (RKT010)
            [
                'description' => 'PC editing midrange 12 juta, VGA dan RAM besar, monitor IPS, cocok untuk kreator konten.',
                'solusi' => 11,
                'solusi_rekomendasi' => 10,
                'description_rekomendasi' => 'Jika budget terbatas, Editing Budget AMD (RKT010) masih bisa diandalkan untuk editing ringan hingga menengah.'
            ],
            // Server Entry (RKT012), upgrade: Server High End (RKT013)
            [
                'description' => 'Server entry 6 juta, sudah cukup untuk virtualisasi ringan, file sharing, dan storage besar.',
                'solusi' => 12,
                'solusi_rekomendasi' => 13,
                'description_rekomendasi' => 'Jika kamu ingin menjalankan lebih banyak VM, database, atau storage besar dan futureproof, pilih Server High End AMD (RKT013) dengan RAM dan PSU lebih besar serta SSD NVMe cepat.'
            ],
            // Server High End (RKT013), downgrade: Server Entry (RKT012)
            [
                'description' => 'Server high end AMD 15 juta, sangat cocok untuk virtualisasi, database, atau aplikasi berat.',
                'solusi' => 13,
                'solusi_rekomendasi' => 12,
                'description_rekomendasi' => 'Jika kebutuhan server kamu masih terbatas, cukup pilih Server Entry (RKT012) agar lebih hemat biaya listrik dan investasi awal.'
            ],
        ]);

        DB::table('rule_categories')->insert([
            // Office Entry Intel
            ['rule_id' => 1, 'category_id' => 2], // Office
            ['rule_id' => 1, 'category_id' => 7], // 2 juta
            ['rule_id' => 1, 'category_id' => 16], // Intel

            // Office Entry AMD
            ['rule_id' => 2, 'category_id' => 2],
            ['rule_id' => 2, 'category_id' => 7],
            ['rule_id' => 2, 'category_id' => 17],

            // Office Futureproof Intel
            ['rule_id' => 3, 'category_id' => 2],
            ['rule_id' => 3, 'category_id' => 9], // 4 juta
            ['rule_id' => 3, 'category_id' => 16],

            // Gaming Hemat Intel
            ['rule_id' => 4, 'category_id' => 1],
            ['rule_id' => 4, 'category_id' => 11], // 5 juta
            ['rule_id' => 4, 'category_id' => 16],

            // Gaming Hemat AMD
            ['rule_id' => 5, 'category_id' => 1],
            ['rule_id' => 5, 'category_id' => 11],
            ['rule_id' => 5, 'category_id' => 17],

            // Gaming Mid Intel
            ['rule_id' => 6, 'category_id' => 1],
            ['rule_id' => 6, 'category_id' => 15], // 9 juta
            ['rule_id' => 6, 'category_id' => 16],

            // Gaming Mid AMD
            ['rule_id' => 7, 'category_id' => 1],
            ['rule_id' => 7, 'category_id' => 15],
            ['rule_id' => 7, 'category_id' => 17],

            // Gaming High Intel
            ['rule_id' => 8, 'category_id' => 1],
            ['rule_id' => 8, 'category_id' => 20], // 14 juta
            ['rule_id' => 8, 'category_id' => 16],

            // Gaming High AMD
            ['rule_id' => 9, 'category_id' => 1],
            ['rule_id' => 9, 'category_id' => 20],
            ['rule_id' => 9, 'category_id' => 17],

            // Editing Budget AMD
            ['rule_id' => 10, 'category_id' => 3], // Editing
            ['rule_id' => 10, 'category_id' => 14], // 8 juta
            ['rule_id' => 10, 'category_id' => 17],

            // Editing Mid Intel
            ['rule_id' => 11, 'category_id' => 3],
            ['rule_id' => 11, 'category_id' => 18], // 12 juta
            ['rule_id' => 11, 'category_id' => 16],

            // Server Entry
            ['rule_id' => 12, 'category_id' => 4], // Server/Virtualisasi
            ['rule_id' => 12, 'category_id' => 12], // 6 juta
            ['rule_id' => 12, 'category_id' => 17],

            // Server High End
            ['rule_id' => 13, 'category_id' => 4],
            ['rule_id' => 13, 'category_id' => 22], // 15 juta
            ['rule_id' => 13, 'category_id' => 17],
        ]);
    }
}
