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

        DB::statement("
            INSERT INTO components (name, code, description, component_type_id, price, is_active, created_at, updated_at) VALUES('ASUS Prime B450M', 'MB001', 'Motherboard untuk AMD Ryzen', 1, 1200000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('Intel Core i5 10400F', 'CPU001', 'Processor Intel generasi ke-10', 2, 2200000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('Corsair Vengeance 8GB', 'RAM001', 'RAM DDR4 8GB', 3, 600000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('NZXT H510', 'CAS001', 'Casing Mid Tower', 4, 900000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('Samsung 970 EVO 500GB', 'STG001', 'SSD NVMe 500GB', 5, 1200000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('WD Blue 1TB', 'STG002', 'HDD 1TB', 5, 700000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('MSI GTX 1660', 'VGA001', 'VGA NVIDIA GTX 1660', 6, 3500000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('Corsair CX550', 'PSU001', 'PSU 550W', 7, 800000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('LG 24MK600', 'MON001', 'Monitor 24 inch IPS', 8, 1500000, 1, '2025-06-10 16:04:01.0', '2025-06-10 16:04:01.0')
            ,('MSI B460M PRO-VDH', 'MB002', 'Motherboard untuk Intel 10th Gen', 1, 1100000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Gigabyte B550M DS3H', 'MB003', 'B550 chipset motherboard AMD', 1, 1350000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('ASRock A320M-HDV R4.0', 'MB004', 'Budget motherboard untuk Ryzen', 1, 850000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('ASUS TUF Gaming B660M', 'MB005', 'Motherboard untuk Intel Gen 12', 1, 1650000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('AMD Ryzen 5 3600', 'CPU002', '6-Core 12-Thread Processor', 2, 2300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Intel Core i3 12100F', 'CPU003', 'Quad-core processor', 2, 1800000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('AMD Ryzen 7 5700G', 'CPU004', 'APU dengan Vega Graphics', 2, 2900000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Intel Core i7 10700K', 'CPU005', '8-core processor untuk gaming', 2, 3700000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('G.SKILL Ripjaws V 16GB', 'RAM002', 'DDR4 3200MHz Dual Channel', 3, 1150000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Kingston Fury Beast 8GB', 'RAM003', 'DDR4 3200MHz CL16', 3, 620000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Team Elite Plus 4GB', 'RAM004', 'DDR4 2666MHz RAM', 3, 300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Corsair Dominator 32GB', 'RAM005', 'High-end DDR4 memory', 3, 2200000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Cooler Master NR400', 'CAS002', 'Micro-ATX case dengan airflow', 4, 800000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Deepcool MATREXX 30', 'CAS003', 'Budget Micro-ATX case', 4, 450000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Lian Li PC-O11 Dynamic', 'CAS004', 'Premium casing dual chamber', 4, 1700000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Aerocool Bolt Mini', 'CAS005', 'Mini Tower stylish casing', 4, 350000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Kingston A2000 1TB', 'STG003', 'NVMe SSD 1TB', 5, 1350000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Seagate Barracuda 2TB', 'STG004', 'HDD 2TB', 5, 950000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Crucial MX500 500GB', 'STG005', 'SATA SSD 500GB', 5, 1000000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('ASUS RTX 3060', 'VGA002', 'VGA NVIDIA RTX 3060', 6, 5000000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Gigabyte RX 6600 XT', 'VGA003', 'VGA AMD RX 6600 XT', 6, 4800000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Zotac GTX 1650', 'VGA004', 'Entry-level gaming GPU', 6, 2600000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('PowerColor RX 580 8GB', 'VGA005', 'Mid-range AMD VGA', 6, 2000000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Seasonic S12III 650W', 'PSU002', 'PSU 80+ Bronze', 7, 950000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('FSP Hexa+ 500W', 'PSU003', 'Budget PSU', 7, 550000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Thermaltake Smart RGB 600W', 'PSU004', 'PSU dengan RGB Fan', 7, 700000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Cooler Master MWE 450W', 'PSU005', 'Entry-level PSU', 7, 600000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('AOC 24G2E', 'MON002', '144Hz Gaming Monitor', 8, 1900000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('ASUS VG249Q', 'MON003', '24 Inch 144Hz IPS monitor', 8, 2300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('Samsung S24R350', 'MON004', 'Monitor 24 Inch Full HD', 8, 1400000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('BenQ GW2480', 'MON005', 'Monitor IPS Eye-Care 24 Inch', 8, 1300000, 1, '2025-06-12 02:35:05.0', '2025-06-12 02:35:05.0')
            ,('ASRock B550M Steel Legend', 'MB006', 'Solid B550 motherboard for AMD', 1, 950000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Gigabyte A520M S2H', 'MB007', 'Entry-level AM4 motherboard', 1, 1600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('ASUS ROG Strix B460-F', 'MB008', 'Gaming motherboard for Intel', 1, 1700000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('MSI MAG B660M Mortar', 'MB009', 'High-performance Intel mATX board', 1, 750000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Biostar A320MH', 'MB010', 'Budget AM4 board', 1, 900000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Intel Pentium G6400', 'CPU006', 'Entry-level Intel dual-core CPU', 2, 750000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('AMD Athlon 3000G', 'CPU007', 'Budget AMD APU', 2, 5200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Intel Core i9 10900K', 'CPU008', 'High-end Intel 10th Gen CPU', 2, 6300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('AMD Ryzen 9 5900X', 'CPU009', '12-core powerhouse CPU', 2, 2300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Intel Core i5 11400', 'CPU010', 'Mid-range Intel CPU', 2, 620000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('ADATA XPG Gammix D30 8GB', 'RAM006', 'DDR4 3200MHz RAM', 3, 1250000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Patriot Viper 4 Blackout 16GB', 'RAM007', 'DDR4 high-performance RAM', 3, 580000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Silicon Power 8GB DDR4', 'RAM008', 'Budget DDR4 RAM', 3, 1600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('G.Skill Trident Z RGB 16GB', 'RAM009', 'RGB high-speed RAM', 3, 1100000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Team T-Force Vulcan Z 16GB', 'RAM010', 'Performance DDR4 RAM', 3, 950000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Fractal Design Focus G', 'CAS006', 'ATX case with tempered glass', 4, 700000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('SilverStone Fara R1', 'CAS007', 'Compact ATX case', 4, 650000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Cooler Master MasterBox Q300L', 'CAS008', 'Versatile Micro-ATX case', 4, 1200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Phanteks Eclipse P400A', 'CAS009', 'High airflow ATX case', 4, 600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Antec NX210', 'CAS010', 'Gaming-oriented ATX case', 4, 400000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('ADATA SU650 240GB', 'STG006', 'SATA SSD for everyday use', 5, 1800000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Seagate FireCuda 510 1TB', 'STG007', 'High-performance NVMe SSD', 5, 720000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Toshiba P300 1TB', 'STG008', 'Reliable desktop HDD', 5, 1250000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Kingston KC2500 500GB', 'STG009', 'NVMe SSD with fast speeds', 5, 480000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Patriot P300 256GB', 'STG010', 'Affordable NVMe SSD', 5, 3400000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('NVIDIA Quadro P620', 'VGA006', 'Entry-level professional GPU', 6, 2800000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('ASUS TUF GTX 1650 Super', 'VGA007', 'Great value gaming GPU', 6, 4300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Gigabyte RTX 3050', 'VGA008', 'New gen RTX GPU', 6, 1900000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('PowerColor RX 570 4GB', 'VGA009', 'Good budget gaming GPU', 6, 4200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Zotac RTX 2060', 'VGA010', 'Mid-range RTX GPU', 6, 850000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Be Quiet! System Power 9 500W', 'PSU006', 'Efficient and quiet PSU', 7, 750000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('EVGA 600 BR', 'PSU007', 'Reliable PSU for budget build', 7, 1200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Seasonic Focus GX-550', 'PSU008', 'Gold-rated PSU', 7, 1300000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Corsair RM650', 'PSU009', 'Fully modular 650W PSU', 7, 600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Thermaltake Smart 500W', 'PSU010', 'Entry-level PSU', 7, 2100000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('MSI Optix G241', 'MON006', '144Hz IPS Gaming Monitor', 8, 1200000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Philips 243V7QDSB', 'MON007', 'Full HD IPS monitor', 8, 1250000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Lenovo D24-20', 'MON008', '24-inch VA monitor', 8, 1350000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('ViewSonic VA2456-MHD', 'MON009', 'Business IPS Monitor', 8, 1600000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('Acer Nitro VG240Y', 'MON010', 'Gaming IPS 75Hz Monitor', 8, 1.60, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('ASUS TUF Gaming B550-PLUS', 'MB011', 'Durable AM4 motherboard', 1, 1700000, 1, '2025-06-12 02:43:32.0', '2025-06-12 02:43:32.0')
            ,('MSI Pro B660M-A DDR4', 'MB012', 'Intel 12th Gen ready motherboard', 1, 1500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Gigabyte Z690 AORUS ELITE AX', 'MB013', 'High-end Intel Z690 chipset', 1, 3200000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Biostar H510MHP', 'MB014', 'Entry Intel 10th Gen mobo', 1, 850000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('AMD Ryzen 5 5600X', 'CPU011', '6-core CPU with high efficiency', 2, 2800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Intel Core i7 12700KF', 'CPU012', 'Alder Lake beast processor', 2, 5600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('AMD Ryzen 7 5800X3D', 'CPU013', 'Gaming-focused 3D cache CPU', 2, 4900000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Kingston Fury Beast 8GB DDR5', 'RAM011', 'High-speed DDR5 RAM', 3, 1500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('G.Skill Ripjaws V 8GB DDR4', 'RAM012', 'Reliable DDR4 performance RAM', 3, 620000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('ADATA XPG Lancer RGB 16GB', 'RAM013', 'DDR5 RAM with RGB for gaming', 3, 2100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Thermaltake Versa H17', 'CAS011', 'Compact micro-ATX case', 4, 500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Deepcool Matrexx 55', 'CAS012', 'Tempered glass case', 4, 950000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Lian Li LANCOOL 215', 'CAS013', 'Airflow-focused tower', 4, 1100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Samsung 980 Pro 1TB', 'STG011', 'PCIe 4.0 ultra-fast SSD', 5, 2300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Crucial BX500 480GB', 'STG012', 'Budget SATA SSD', 5, 600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('WD Black SN850 500GB', 'STG013', 'Gaming NVMe SSD', 5, 1800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('MSI RTX 3060 Ti Ventus', 'VGA011', 'Ray tracing GPU with DLSS', 6, 6300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('PowerColor RX 6600 XT', 'VGA012', 'Mid-range GPU from AMD', 6, 4600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('ASUS ROG Strix RTX 3070 OC', 'VGA013', 'Powerful 1440p gaming GPU', 6, 9000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('FSP Hyper K 600W', 'PSU011', 'Budget 600W PSU', 7, 650000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Cooler Master MWE 650 Bronze', 'PSU012', 'Semi-modular Bronze certified PSU', 7, 850000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('DeepCool DN500', 'PSU013', 'Entry-level PSU', 7, 500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('LG 27GN750-B', 'MON011', '240Hz esports-grade monitor', 8, 4800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('ViewSonic XG2405', 'MON012', 'Fast IPS gaming monitor', 8, 2900000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('AOC C24G1', 'MON013', 'Curved 144Hz gaming monitor', 8, 2300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Intel Arc A770 16GB', 'VGA014', 'Intel''s high-performance gaming GPU', 6, 5000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('ASUS Dual RTX 4060 OC', 'VGA015', 'Latest generation RTX GPU', 6, 5500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('MSI MEG Z790 ACE', 'MB015', 'Flagship Intel Z790 motherboard', 1, 8000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Intel Core i3 12100F', 'CPU014', 'Budget 12th Gen Intel processor', 2, 1500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('AMD Ryzen 3 4100', 'CPU015', 'Affordable 4-core CPU', 2, 1100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('G.Skill Flare X 8GB DDR4', 'RAM014', 'AMD-optimized RAM', 3, 640000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Lexar NM610 500GB', 'STG014', 'Entry-level NVMe SSD', 5, 720000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Transcend 820S 240GB', 'STG015', 'Budget SATA SSD', 5, 420000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Thermaltake Toughpower 750W', 'PSU014', 'High-capacity PSU for gaming builds', 7, 1350000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('ASUS VG259Q', 'MON014', '144Hz gaming IPS display', 8, 2800000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('MSI Optix MAG274QRF-QD', 'MON015', '165Hz QHD gaming monitor', 8, 5500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Cougar MX330', 'CAS014', 'Mid-tower case with mesh front', 4, 650000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Montech Air 100 ARGB', 'CAS015', 'Airflow-focused with RGB', 4, 850000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Biostar A68N-5600', 'MB016', 'Motherboard with built-in APU', 1, 950000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('HP EX900 1TB', 'STG016', 'Fast and reliable NVMe SSD', 5, 1750000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Seagate Barracuda 2TB', 'STG017', 'High-capacity HDD', 5, 1050000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('GALAX RTX 3080 SG', 'VGA016', 'High-end gaming GPU', 6, 12000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('AMD Radeon RX 6750 XT', 'VGA017', 'Strong 1440p performance GPU', 6, 6500000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('FSP Hydro GT 750W', 'PSU015', 'Gold-certified modular PSU', 7, 1550000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Thermaltake V250 TG ARGB', 'CAS016', 'RGB mid-tower ATX case', 4, 1100000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Acer Nitro VG270', 'MON016', '27-inch gaming IPS screen', 8, 2600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('ASRock A320M-HDV', 'MB017', 'Value AM4 motherboard', 1, 780000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Intel Xeon E-2236', 'CPU016', 'Workstation CPU', 2, 3600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Transcend JetRAM 8GB', 'RAM015', 'Basic DDR4 RAM', 3, 590000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Patriot Burst Elite 240GB', 'STG018', 'Affordable SSD for boot drive', 5, 410000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('SilverStone ST50F-ES230 500W', 'PSU016', 'Entry-level PSU from SilverStone', 7, 580000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Dell S2721DGF', 'MON017', '165Hz QHD professional gaming monitor', 8, 6000000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('ASUS ProArt B550-Creator', 'MB018', 'Professional AMD motherboard', 1, 3400000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Corsair Vengeance RGB RS 16GB', 'RAM016', 'DDR4 with vibrant RGB', 3, 1300000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('WD Green 240GB SATA', 'STG019', 'Basic SSD for everyday use', 5, 400000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Inno3D GTX 1050 Ti', 'VGA018', 'Entry gaming GPU', 6, 1600000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0')
            ,('Palit RTX 4060 Dual', 'VGA019', 'Budget-friendly RTX 4060', 6, 4900000, 1, '2025-06-12 02:46:56.0', '2025-06-12 02:46:56.0');
        ");

        DB::table('rakitan')->insert([
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
            // [
            //     'name' => 'Socket Motherboard',
            //     'pertanyaan' => 'Berapa budget yang Anda miliki?',
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
        ]);

        DB::table('categories')->insert([
            ['code' => 'NEED1', 'name' => 'Gaming', 'value' => 'gaming', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED2', 'name' => 'Office / Kerja Ringan', 'value' => 'office', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED3', 'name' => 'Editing Video & Rendering', 'value' => 'editing', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED4', 'name' => 'Server / Virtualisasi', 'value' => 'server', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED5', 'name' => 'Browsing & Multimedia', 'value' => 'multimedia', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'NEED6', 'name' => 'Desain Grafis', 'value' => 'design', 'clasification_id' => 1, 'created_at' => now(), 'updated_at' => now()],
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

            // // Socket Motherboard
            // ['code' => 'SOC1', 'name' => 'LGA1151 (Intel Gen 6-9)', 'value' => 'lga1151', 'clasification_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['code' => 'SOC2', 'name' => 'LGA1200 (Intel Gen 10-11)', 'value' => 'lga1200', 'clasification_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['code' => 'SOC3', 'name' => 'LGA1700 (Intel Gen 12-14)', 'value' => 'lga1700', 'clasification_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['code' => 'SOC4', 'name' => 'AM3+ (AMD FX series)', 'value' => 'am3plus', 'clasification_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['code' => 'SOC5', 'name' => 'AM4 (Ryzen 1000–5000)', 'value' => 'am4', 'clasification_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            // ['code' => 'SOC6', 'name' => 'AM5 (Ryzen 7000 series)', 'value' => 'am5', 'clasification_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('categories')->insert([
            ['code' => 'CPU01', 'name' => 'Intel', 'value' => 'intel', 'clasification_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'CPU02', 'name' => 'AMD', 'value' => 'amd', 'clasification_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
