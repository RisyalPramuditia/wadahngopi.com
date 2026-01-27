<?php

namespace Database\Seeders;

use App\Models\Cafe;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class AuthenticMenuSeeder extends Seeder
{
    /**
     * Seed menus for all cafes with authentic data
     */
    public function run(): void
    {
        $menus = [
            'Fren.co Coffee & Eatery' => [
                ['name' => 'Fren.co Signature Latte', 'price' => 32000, 'type' => 'coffee', 'description' => 'Creamy palm sugar latte with a hint of caramel', 'image_path' => 'https://images.unsplash.com/photo-1541167760496-1628856ab752?w=800'],
                ['name' => 'Nasi Goreng Fren', 'price' => 38000, 'type' => 'food', 'description' => 'Special fried rice with smoked beef and sunny side up', 'image_path' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800'],
                ['name' => 'Spaghetti Carbonara', 'price' => 45000, 'type' => 'food', 'description' => 'Creamy pasta with smoked beef and parmesan crisp', 'image_path' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=800'],
                ['name' => 'Ice Lychee Tea', 'price' => 25000, 'type' => 'non-coffee', 'description' => 'Refreshing black tea with whole lychee fruit', 'image_path' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=800'],
                ['name' => 'Chicken Katsu Curry', 'price' => 42000, 'type' => 'food', 'description' => 'Crispy chicken katsu with rich Japanese curry sauce', 'image_path' => 'https://images.unsplash.com/photo-1588166524941-3bf61a9c41db?w=800'],
                ['name' => 'Affogato', 'price' => 28000, 'type' => 'coffee', 'description' => 'Vanilla ice cream drowned in hot espresso', 'image_path' => 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=800'],
            ],
            'Kopi Botol Alaya' => [
                ['name' => 'Kopi Susu Gula Aren (Botol)', 'price' => 25000, 'type' => 'coffee', 'description' => 'Signature bottled palm sugar coffee, ready to go', 'image_path' => 'https://images.unsplash.com/photo-1578314675249-a6910f80cc4e?w=800'],
                ['name' => 'Creamy Matcha (Botol)', 'price' => 28000, 'type' => 'non-coffee', 'description' => 'Premium matcha latte in a convenient bottle', 'image_path' => 'https://images.unsplash.com/photo-1515825838458-f2a94b20105a?w=800'],
                ['name' => 'Dark Chocolate (Botol)', 'price' => 28000, 'type' => 'non-coffee', 'description' => 'Rich artisan chocolate milk', 'image_path' => 'https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?w=800'],
                ['name' => 'Beef Mentai Rice', 'price' => 45000, 'type' => 'food', 'description' => 'Rice bowl topped with beef slices and torched mentai sauce', 'image_path' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=800'],
                ['name' => 'Dimsum Mentai', 'price' => 35000, 'type' => 'food', 'description' => 'Steamed chicken dumplings with spicy mentai sauce', 'image_path' => 'https://images.unsplash.com/photo-1496116218417-1a781b1c416c?w=800'],
            ],
            'Titik Koma Antasari' => [
                ['name' => 'Kopi Susu Tiger', 'price' => 28000, 'type' => 'coffee', 'description' => 'Our famous brown sugar boba-inspired coffee latte', 'image_path' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=800'],
                ['name' => 'Aren Latte Double Shot', 'price' => 32000, 'type' => 'coffee', 'description' => 'Stronger kick with double espresso and palm sugar', 'image_path' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=800'],
                ['name' => 'Sea Salt Cocoa', 'price' => 35000, 'type' => 'non-coffee', 'description' => 'Premium cocoa with a hint of sea salt savory', 'image_path' => 'https://images.unsplash.com/photo-1544145945-f904253db0ad?w=800'],
                ['name' => 'Kaya Toast', 'price' => 25000, 'type' => 'food', 'description' => 'Crispy toast with homemade kaya jam and butter', 'image_path' => 'https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=800'],
                ['name' => 'Platter Gorengan', 'price' => 45000, 'type' => 'food', 'description' => 'Mix platter of fries, sausage, and nuggets', 'image_path' => 'https://images.unsplash.com/photo-1573080496987-a221b6540d9b?w=800'],
            ],
            'Starbucks Big Mall' => [
                ['name' => 'Caramel Macchiato', 'price' => 59000, 'type' => 'coffee', 'description' => 'Freshly steamed milk with vanilla-flavored syrup marked with espresso and topped with a caramel drizzle', 'image_path' => 'https://images.unsplash.com/photo-1485808191679-5f8c7c41f7bc?w=800'],
                ['name' => 'Java Chip Frappuccino', 'price' => 63000, 'type' => 'coffee', 'description' => 'Mocha sauce and Frappuccino chips blended with coffee', 'image_path' => 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=800'],
                ['name' => 'Green Tea Latte', 'price' => 61000, 'type' => 'non-coffee', 'description' => 'Smooth and creamy matcha sweetened just right', 'image_path' => 'https://images.unsplash.com/photo-1515825838458-f2a94b20105a?w=800'],
                ['name' => 'Asian Dolce Latte', 'price' => 58000, 'type' => 'coffee', 'description' => 'Double shot espresso with dolce sauce', 'image_path' => 'https://images.unsplash.com/photo-1534040385115-33dcb3ac58b6?w=800'],
                ['name' => 'Almond Croissant', 'price' => 42000, 'type' => 'food', 'description' => 'Buttery croissant topped with almond slices', 'image_path' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=800'],
                ['name' => 'Via Red Velvet Roll', 'price' => 45000, 'type' => 'food', 'description' => 'Soft red velvet sponge cake with cream cheese', 'image_path' => 'https://images.unsplash.com/photo-1616541823729-00fe0aacd32c?w=800'],
            ],
            'Kolektif Coffee' => [
                ['name' => 'Manual Brew V60', 'price' => 35000, 'type' => 'coffee', 'description' => 'Pour over coffee using seasonal single origin beans', 'image_path' => 'https://images.unsplash.com/photo-1498804103079-a6351b050096?w=800'],
                ['name' => 'Magic Latte', 'price' => 35000, 'type' => 'coffee', 'description' => 'Double ristretto with perfectly textured milk', 'image_path' => 'https://images.unsplash.com/photo-1551024601-bec0273e8a9e?w=800'],
                ['name' => 'Earl Grey Milk Tea', 'price' => 32000, 'type' => 'non-coffee', 'description' => 'Fragrant earl grey tea with fresh milk', 'image_path' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=800'],
                ['name' => 'Truffle Fries', 'price' => 40000, 'type' => 'food', 'description' => 'Shoestring fries tossed in truffle oil and parmesan', 'image_path' => 'https://images.unsplash.com/photo-1573080496987-a221b6540d9b?w=800'],
            ],
             'Toko Kopi Maru' => [
                ['name' => 'Kopi Maru', 'price' => 22000, 'type' => 'coffee', 'description' => 'Es kopi susu gula aren dengan resep rahasia Maru', 'image_path' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800'],
                ['name' => 'Roti Bakar Kaya', 'price' => 25000, 'type' => 'food', 'description' => 'Roti bakar tradisional dengan selai srikaya', 'image_path' => 'https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=800'],
                ['name' => 'Teh Tarik Malaka', 'price' => 20000, 'type' => 'non-coffee', 'description' => 'Teh tarik authentic dengan buih melimpah', 'image_path' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=800'],
                ['name' => 'Mie Goreng Mamak', 'price' => 32000, 'type' => 'food', 'description' => 'Mie goreng rempah khas melayu', 'image_path' => 'https://images.unsplash.com/photo-1612929633738-8fe44f7ec841?w=800'],
            ],
            // Generic set for others
            'default' => [
                ['name' => 'House Blend Latte', 'price' => 28000, 'type' => 'coffee', 'description' => 'Creamy latte using our signature house blend beans', 'image_path' => 'https://images.unsplash.com/photo-1551024601-bec0273e8a9e?w=800'],
                ['name' => 'Americano On Rocks', 'price' => 25000, 'type' => 'coffee', 'description' => 'Double espresso poured over ice', 'image_path' => 'https://images.unsplash.com/photo-1517487881594-2787fef5ebf7?w=800'],
                ['name' => 'Caramel Frappe', 'price' => 35000, 'type' => 'coffee', 'description' => 'Ice blended coffee with rich caramel sauce', 'image_path' => 'https://images.unsplash.com/photo-1572490122747-3968b75cc699?w=800'],
                ['name' => 'Signature Chocolate', 'price' => 32000, 'type' => 'non-coffee', 'description' => 'Thick and creamy Belgian chocolate drink', 'image_path' => 'https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?w=800'],
                ['name' => 'Lychee Yakult', 'price' => 28000, 'type' => 'non-coffee', 'description' => 'Probiotic drink mixed with sweet lychee syrup', 'image_path' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=800'],
                ['name' => 'Club Sandwich', 'price' => 45000, 'type' => 'food', 'description' => 'Triple decker sandwich with chicken, egg, and cheese', 'image_path' => 'https://images.unsplash.com/photo-1528735602780-2552fd46c7af?w=800'],
                ['name' => 'Loaded Fries', 'price' => 38000, 'type' => 'food', 'description' => 'Crispy fries topped with melted cheese and beef bacon', 'image_path' => 'https://images.unsplash.com/photo-1573080496987-a221b6540d9b?w=800'],
                ['name' => 'Banana Fritters', 'price' => 25000, 'type' => 'food', 'description' => 'Fried banana topped with cheese and chocolate condensed milk', 'image_path' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=800'],
            ]
        ];

        // Cafes seeded in DatabaseSeeder
        $targetCafes = [
            'Fren.co Coffee & Eatery', 'Kopi Botol Alaya', 'Titik Koma Antasari',
            'Starbucks Big Mall', 'Kolektif Coffee', 'Toko Kopi Maru',
            'Dunamos Coffee', 'satukata coffee co.', 'Dua Lima Coffee',
            'YOU Coffee', 'Kopi Bahagia'
        ];

        foreach ($targetCafes as $cafeName) {
            $cafe = Cafe::where('name', $cafeName)->first();
            
            if (!$cafe) continue;

            // Delete factory menus
            $cafe->menus()->delete();

            // Select menu set: Specific or Default
            $menuSet = $menus[$cafeName] ?? $menus['default'];

            foreach ($menuSet as $item) {
                Menu::factory()->create(array_merge($item, ['cafe_id' => $cafe->id]));
            }
        }
        
        $this->command->info('✅ Authentic menus seeded for all ' . count($targetCafes) . ' additional cafes.');
    }
}
