<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Facilities & Opening Hours
        $this->call([
            FacilitiesSeeder::class,
            CafeOpeningHoursSeeder::class,
        ]);

        // 2. Admin Account
        User::factory()->create([
            'name' => 'WadahNgopi Admin',
            'email' => 'admin@wadahngopi.test',
            'role' => 'admin',
        ]);

        // 3. Cafe Data with Unique Owners
        $samarindaCafes = [
            [
                'name' => 'Coffee & Co. - SOUL',
                'tagline' => 'Premium Coffee & Dining Experience',
                'description' => 'Coffee & Co. SOUL adalah coffee shop premium yang dibuka pada 31 Mei 2025 di City Centrum Samarinda. Kami menghadirkan pengalaman kopi berkualitas tinggi dengan menu yang beragam, mulai dari specialty coffee, pastry artisan, hingga hidangan berat. Dengan suasana yang nyaman, AC indoor, dan area smoking yang luas, Coffee & Co. SOUL menjadi tempat sempurna untuk bekerja, bersantai, atau berkumpul bersama teman. Kami berkomitmen untuk memberikan pelayanan terbaik dan cita rasa yang tak terlupakan di setiap cangkir kopi dan hidangan yang kami sajikan.',
                'address' => 'City Centrum Mall, 1st Floor, Samarinda',
                'rating' => 4.9,
                'image_path' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&q=80&w=1200',
                'menu_image_path' => 'https://images.unsplash.com/photo-1559925393-8be0ec41b504?auto=format&fit=crop&q=80&w=1000',
                'latitude' => -0.502812,
                'longitude' => 117.151240,
                'status' => 'published',
                'google_maps_url' => 'https://maps.app.goo.gl/CitycentrumSamarinda',
                'whatsapp_number' => '6282157777777',
                'instagram_url' => 'https://instagram.com/coffeeandco.soul',
                'tiktok_url' => 'https://tiktok.com/@coffeeandco.soul',
            ],
            [
                'name' => 'Fren.co Coffee & Eatery',
                'tagline' => 'Great Food, Better Coffee, Best Friends.',
                'description' => 'Fren.co hadir sebagai ruang temu yang hangat untuk setiap cerita. Menyajikan perpaduan sempurna antara kopi pilihan dan hidangan comfort food yang menggugah selera. Dari brunch santai hingga makan malam intim, kami siap menemani momen berhargamu bersama sahabat dan keluarga.',
                'address' => 'Jl. Siradj Salman No.6a, Samarinda',
                'rating' => 4.5,
                'image_path' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=1200',
                'menu_image_path' => 'https://images.unsplash.com/photo-1544145945-f904253db0ad?auto=format&fit=crop&q=80&w=1000',
                'latitude' => -0.490123,
                'longitude' => 117.123456,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Fren.co+Samarinda',
                'instagram_url' => 'https://instagram.com/fren.co',
            ],
            [
                'name' => 'Kolektif Coffee',
                'tagline' => 'Simplicity in every cup.',
                'description' => 'Kolektif Coffee mengusung konsep minimalis industrial yang menenangkan. Kami percaya bahwa kopi enak tidak harus rumit. Fokus kami adalah pada bean berkualitas yang diseduh dengan presisi untuk menonjolkan karakter rasa terbaiknya.',
                'address' => 'Jl. Wijaya Kusuma, Samarinda',
                'rating' => 4.7,
                'image_path' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=1200',
                'menu_image_path' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&q=80&w=1000',
                'latitude' => -0.485678,
                'longitude' => 117.145678,
                'status' => 'published',
                'instagram_url' => 'https://instagram.com/kolektif.coffee',
            ],
            [
                'name' => 'Dunamos Coffee',
                'tagline' => 'Your third place for social and coffee.',
                'description' => 'Dunamos bukan sekadar kedai kopi, melainkan ruang ketiga bagi komunitas. Nama "Dunamos" diambil dari kata "Dinamis", mencerminkan semangat kami untuk terus bergerak dan berinovasi. Dengan interior modern yang luas, kami menyediakan tempat yang nyaman untuk bekerja, berdiskusi, atau sekadar menikmati sore yang tenang.',
                'address' => 'Jl. M. Yamin No.12, Samarinda',
                'rating' => 4.8,
                'image_path' => 'https://images.unsplash.com/photo-1511920170033-f83969a4c348?auto=format&fit=crop&q=80&w=1200',
                'menu_image_path' => 'https://images.unsplash.com/photo-1498804103079-a6351b050096?auto=format&fit=crop&q=80&w=1000',
                'latitude' => -0.478901,
                'longitude' => 117.156789,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Dunamos+Coffee+Samarinda',
                'instagram_url' => 'https://instagram.com/dunamos.coffee',
                'whatsapp_number' => '628115555555',
            ],
            [
                'name' => 'satukata coffee co.',
                'tagline' => 'Satu kata untuk sejuta rasa.',
                'description' => 'Satukata percaya bahwa setiap cangkir kopi memiliki ceritanya sendiri. Filosofi kami sederhana: menyajikan kopi yang jujur. Kami bekerja sama langsung dengan petani lokal untuk mendapatkan biji kopi terbaik, lalu menyeduhnya dengan hati-hati untuk memastikan setiap sip memberikan kehangatan dan kepuasan.',
                'address' => 'Jl. Basuki Rahmat, Samarinda',
                'rating' => 4.6,
                'image_path' => 'https://images.unsplash.com/photo-1481833761820-0509d3217039?auto=format&fit=crop&q=80&w=1200',
                'menu_image_path' => 'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?auto=format&fit=crop&q=80&w=1000',
                'latitude' => -0.491234,
                'longitude' => 117.141234,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Satukata+Coffee+Samarinda',
                'instagram_url' => 'https://instagram.com/satukata.coffee',
                'tiktok_url' => 'https://tiktok.com/@satukata.kp',
            ],
            [
                'name' => 'Titik Koma Antasari',
                'tagline' => 'Tempat istirahat sejenak di tengah kesibukan.',
                'description' => 'Titik Koma hadir sebagai jeda yang manis di tengah rutinitasmu. Nikmati varian kopi susu khas kami yang creamy dan menyegarkan, ditemani suasana santai yang pas untuk obrolan ringan maupun me-time.',
                'address' => 'Jl. P Antasari No.20 B, Samarinda',
                'rating' => 4.8,
                'image_path' => 'https://images.unsplash.com/photo-1559925393-8be0ec41b504?auto=format&fit=crop&q=80&w=1200',
                'menu_image_path' => 'https://images.unsplash.com/photo-1521017432531-fbd92d768814?auto=format&fit=crop&q=80&w=1000',
                'latitude' => -0.495678,
                'longitude' => 117.135678,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Titik+Koma+Antasari',
                'instagram_url' => 'https://instagram.com/titikkoma.antasari',
                'whatsapp_number' => '6281234567891',
            ],
            [
                'name' => 'Toko Kopi Maru',
                'tagline' => 'Legendary taste in modern vibes.',
                'description' => 'Toko Kopi Maru menggabungkan nostalgia kedai kopi klasik dengan sentuhan modern. Kami mempertahankan resep tradisional kopi tiam yang autentik, disajikan dalam suasana kontemporer yang nyaman. Tempat di mana generasi tua dan muda bisa duduk bersama menikmati kopi.',
                'address' => 'Jl. Antasari, Samarinda',
                'rating' => 4.7,
                'image_path' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&q=80&w=1200',
                'latitude' => -0.496789,
                'longitude' => 117.136789,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Toko+Kopi+Maru+Samarinda',
                'instagram_url' => 'https://instagram.com/tokokopimaru',
            ],
            [
                'name' => 'Dua Lima Coffee',
                'tagline' => 'Casual hangout for everyone.',
                'description' => 'Dua Lima Coffee adalah spot nongkrong favorit yang inklusif dan ramah. Dengan area outdoor yang luas dan live music setiap akhir pekan, kami menciptakan atmosfer santai yang mengundang siapa saja untuk datang, tertawa, dan berbagi cerita ditemani kopi enak.',
                'address' => 'Jl. Lambung Mangkurat, Samarinda',
                'rating' => 4.5,
                'image_path' => 'https://images.unsplash.com/photo-1445116572660-236099ec97a2?auto=format&fit=crop&q=80&w=1200',
                'latitude' => -0.487654,
                'longitude' => 117.148901,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Dua+Lima+Coffee+Samarinda',
                'instagram_url' => 'https://instagram.com/dualima.coffee',
            ],
            [
                'name' => 'Kopi Botol Alaya',
                'tagline' => 'Simply Authentic, Ready to Go.',
                'description' => 'Nikmati kopi premium dalam kemasan yang praktis. Kopi Botol Alaya menghadirkan cita rasa kopi susu gula aren yang creamy dan authentic, diracik khusus untuk menemani aktivitas dinamis Anda. Pilihan tepat untuk grab-and-go dengan kualitas rasa yang konsisten.',
                'address' => 'Alaya Junction, Samarinda',
                'rating' => 4.4,
                'image_path' => 'https://images.unsplash.com/photo-1507133750040-4a8f57021571?auto=format&fit=crop&q=80&w=1200',
                'menu_image_path' => 'https://images.unsplash.com/photo-1623934199716-dc28818a6ec7?auto=format&fit=crop&q=80&w=1000',
                'latitude' => -0.467890,
                'longitude' => 117.178901,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Alaya+Junction+Samarinda',
                'instagram_url' => 'https://instagram.com/kopibotol.alaya',
                'whatsapp_number' => '6282198765432',
            ],
            [
                'name' => 'YOU Coffee',
                'tagline' => 'Brunch and Coffee, made just for YOU.',
                'description' => 'YOU Coffee didedikasikan untuk memanjakan lidah Anda. Kami tidak hanya menyajikan kopi spesialti, tetapi juga rangkaian menu brunch lezat yang dibuat dari bahan-bahan segar setiap hari. Suasana homey kami membuat Anda merasa seperti sedang bersantap di rumah sendiri.',
                'address' => 'Jl. Gamelan No.2, Samarinda',
                'rating' => 4.8,
                'image_path' => 'https://images.unsplash.com/photo-1517705008128-361805f42e86?auto=format&fit=crop&q=80&w=1200',
                'latitude' => -0.481234,
                'longitude' => 117.151234,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=YOU+Coffee+Samarinda',
                'instagram_url' => 'https://instagram.com/you.coffee.samarinda',
            ],
            [
                'name' => 'Starbucks Big Mall',
                'tagline' => 'To inspire and nurture the human spirit.',
                'address' => 'Big Mall Samarinda, G Floor',
                'rating' => 4.9,
                'image_path' => 'https://images.unsplash.com/photo-1541167760496-1628856ab772?auto=format&fit=crop&q=80&w=1200',
                'latitude' => -0.518123,
                'longitude' => 117.111234,
                'status' => 'published',
                'description' => 'Nikmati pengalaman kopi kelas dunia di Starbucks Big Mall. Dengan suasana yang nyaman dan pemandangan Sungai Mahakam, kami menyajikan berbagai pilihan minuman kopi handcrafted dan makanan lezat untuk menemani momen santai Anda.',
                'google_maps_url' => 'https://maps.google.com/?q=Starbucks+Big+Mall+Samarinda',
            ],
            [
                'name' => 'Kopi Bahagia',
                'tagline' => 'Start your day with happiness.',
                'description' => 'Kopi Bahagia lahir dari keinginan sederhana: membuat orang tersenyum melalui secangkir kopi. Kami menggunakan biji kopi lokal Indonesia yang diproses dengan penuh cinta. Harga terjangkau, rasa memukau, dan pelayanan ramah adalah janji kami kepada setiap pelanggan.',
                'address' => 'Jl. Juanda, Samarinda',
                'rating' => 4.6,
                'image_path' => 'https://images.unsplash.com/photo-1498804103079-a6351b050096?auto=format&fit=crop&q=80&w=1200',
                'latitude' => -0.482000,
                'longitude' => 117.132000,
                'status' => 'published',
                'google_maps_url' => 'https://maps.google.com/?q=Kopi+Bahagia+Samarinda',
                'instagram_url' => 'https://instagram.com/kopibahagia.id',
                'whatsapp_number' => '6285255566677',
            ],
        ];

        // Create a single owner for all real cafes to simplify testing
        $testOwner = User::factory()->create([
            'name' => 'WadahNgopi Owner',
            'email' => 'owner@wadahngopi.test',
            'role' => 'owner',
        ]);

        foreach ($samarindaCafes as $index => $cafeData) {
            try {
                $cafe = \App\Models\Cafe::factory()
                    ->hasReviews(fake()->numberBetween(3, 5))
                    ->create(array_merge($cafeData, ['owner_id' => $testOwner->id]));

                // Attach random facilities
                $facilities = \App\Models\Facility::inRandomOrder()->take(rand(3, 6))->pluck('id');
                $cafe->facilities()->attach($facilities);
            } catch (\Exception $e) {
                $this->command->error("Failed to seed cafe: " . $cafeData['name']);
                $this->command->error($e->getMessage());
            }
        }

        // Seed Authentic Menus for ALL Cafes
        $this->call([
            CoffeeAndCoMenuSeeder::class, // Special Handling for Coffee & Co
            AuthenticMenuSeeder::class,   // Handling for all other cafes
        ]);

        // 4. Seed Information/News
        $categories = ['Berita', 'Edukasi', 'Lomba'];
        foreach ($categories as $cat) {
            \App\Models\Information::factory(2)->create([
                'category' => $cat,
                'is_published' => true,
                'published_at' => now(),
            ]);
        }
    }
}
