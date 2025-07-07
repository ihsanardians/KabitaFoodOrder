<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->delete();

        // Data Main Course
        Product::create([
            'name' => 'Chicken Wings Spicy',
            'category' => 'Main Course',
            'price' => 17000,
            'description' => 'Chicken wings renyah dengan saus pedas nikmat, bikin nagih di setiap gigitan!',
            'image' => 'products/chicken-spicy-wings.jpg' 
        ]);
        Product::create([
            'name' => 'Paket Jomblo (1 Orang)',
            'category' => 'Main Course',
            'price' => 25000,
            'description' => '1 Pack Grill(Beef Slice Barbeque/Lada Hitam, Beef Enoki, Chicken slice Barbeque/Lada Hitam, Sosis) & 1 Pack Shabu (Sayur, Chikua, Fish Tofu, Crab Stick)',
            'image' => 'products/paket-jomblo.png'
        ]);
        Product::create([
            'name' => 'Paket Pacar (2 Orang)',
            'category' => 'Main Course',
            'price' => 18000,
            'description' => '2 Pack Grill(Beef Slice Barbeque/Lada Hitam, Beef Enoki, Chicken slice Barbeque/Lada Hitam, Sosis) & 2 Pack Shabu (Sayur, Chikua, Fish Tofu, Crab Stick)',
            'image' => 'products/paket-pacar.jpg'
        ]);
        Product::create([
            'name' => 'Paket Sahabat (4 Orang)',
            'category' => 'Main Course',
            'price' => 18000,
            'description' => '4 Pack Grill(Beef Slice Barbeque/Lada Hitam, Beef Enoki, Chicken slice Barbeque/Lada Hitam, Sosis) & 4 Pack Shabu (Sayur, Chikua, Fish Tofu, Crab Stick)',
            'image' => 'products/paket-sahabat.jpg'
        ]);

        // Data Add On
        Product::create([
            'name' => 'Beef Slice Barbeque',
            'category' => 'Add On',
            'price' => 15000,
            'description' => 'Beef Slice Barbeque (50gr)',
            'image' => 'products/beef-slice.png'
        ]);
        Product::create([
            'name' => 'Beef Slice Lada Hitam',
            'category' => 'Add On',
            'price' => 15000,
            'description' => 'Beef Slice Lada Hitam (50gr)',
            'image' => 'products/beef-slice.png'
        ]);
        Product::create([
            'name' => 'Beef Enoki',
            'category' => 'Add On',
            'price' => 15000,
            'description' => 'Beef Enoki 3 pcs',
            'image' => 'products/beef-enoki.jpeg'
        ]);
        Product::create([
            'name' => 'Chicken Slice Barbeque',
            'category' => 'Add On',
            'price' => 10000,
            'description' => 'Chicken Slice Barbeque (50gr)',
            'image' => 'products/chicken-slice.jpeg'
        ]);
        Product::create([
            'name' => 'Chicken Slice Lada Hitam',
            'category' => 'Add On',
            'price' => 10000,
            'description' => 'Chicken Slice Lada Hitam (50gr)',
            'image' => 'products/chicken-slice.jpeg'
        ]);
        Product::create([
            'name' => 'Sosis',
            'category' => 'Add On',
            'price' => 3000,
            'description' => 'Sosis 1 pcs',
            'image' => 'products/sosis.jpg'
        ]);

        Product::create([
            'name' => 'Bola Salmon',
            'category' => 'Add On',
            'price' => 2000,
            'description' => 'Bola Salmon 1 pcs',
            'image' => 'products/bola-salmon.jpeg'
        ]);
        Product::create([
            'name' => 'Chikua',
            'category' => 'Add On',
            'price' => 5000,
            'description' => 'Chikua 3 pcs',
            'image' => 'products/Chikuwa.jpg'
        ]);
        Product::create([
            'name' => 'Jamur Enoki',
            'category' => 'Add On',
            'price' => 3000,
            'description' => 'Jamur Enoki 1 pcs',
            'image' => 'products/enoki.jpeg'
        ]);
        Product::create([
            'name' => 'Dumpling Ayam',
            'category' => 'Add On',
            'price' => 5000,
            'description' => 'Dumpling Ayam 2 pcs',
            'image' => 'products/dumpling-ayam.jpeg'
        ]);
        Product::create([
            'name' => 'Fish Tofu',
            'category' => 'Add On',
            'price' => 5000,
            'description' => 'Fish Tofu 4 pcs',
            'image' => 'products/fish-tofu.jpg'
        ]);
        Product::create([
            'name' => 'Sayuran',
            'category' => 'Add On',
            'price' => 3000,
            'description' => 'Sayuran',
            'image' => 'products/sayuran.jpg'
        ]);
        Product::create([
            'name' => 'Crab Stick',
            'category' => 'Add On',
            'price' => 5000,
            'description' => 'Bola Salmon 3 pcs',
            'image' => 'products/crab-stick.jpg'
        ]);
        Product::create([
            'name' => 'Nasi',
            'category' => 'Add On',
            'price' => 4000,
            'description' => 'Nasi Putih',
            'image' => 'products/nasi.jpg'
        ]);
        Product::create([
            'name' => 'Extra Sauce',
            'category' => 'Add On',
            'price' => 3000,
            'description' => 'Extra Sauce Cheese/Spicy',
            'image' => 'products/saus.jpeg'
        ]);


        

        // Data Dessert
        Product::create([
            'name' => 'Mango Sticky Rice',
            'category' => 'Dessert',
            'price' => 1200,
            'description' => 'Ketan pulen dengan santan gurih dan mangga segar — sajian manis khas Thailand yang menggoda selera.',
            'image' => 'products/mango-sticky-rice.jpg'
        ]);
        Product::create([
            'name' => 'Sago Mangga',
            'category' => 'Dessert',
            'price' => 13000,
            'description' => 'Sagu lembut dan saus mangga manis dengan potongan buah segar, sajian penutup yang ringan dan menyegarkan.',
            'image' => 'products/sago-buah-mangga.jpg'
        ]);
        Product::create([
            'name' => 'Salad Buah',
            'category' => 'Dessert',
            'price' => 15000,
            'description' => 'Buah segar berpadu saus creamy, segar dan nikmat di setiap suapan.',
            'image' => 'products/salad-buah.jpg'
        ]);
        Product::create([
            'name' => 'Es Teler',
            'category' => 'Dessert',
            'price' => 13000,
            'description' => 'Segarnya alpukat, kelapa, dan nangka dalam semangkuk es teler yang manis dan menggoda!',
            'image' => 'products/es-teler.jpg'
        ]);
    }
}