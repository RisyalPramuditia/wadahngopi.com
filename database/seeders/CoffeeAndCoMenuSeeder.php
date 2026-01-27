<?php

namespace Database\Seeders;

use App\Models\Cafe;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class CoffeeAndCoMenuSeeder extends Seeder
{
    /**
     * Seed Coffee & Co SOUL menu with real 2026 prices from GoFood
     */
    public function run(): void
    {
        $cafe = Cafe::where('name', 'Coffee & Co. - SOUL')->first();

        if (!$cafe) {
            $this->command->warn('Coffee & Co. - SOUL cafe not found. Skipping menu seeding.');
            return;
        }

        // Delete existing menus for this cafe
        $cafe->menus()->delete();

        $menus = [
            // COFFEE - Hot
            [
                'name' => 'Cappuccino',
                'price' => 36300,
                'type' => 'coffee',
                'description' => 'Classic Italian espresso with steamed milk and foam',
                'image_path' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Caffe Latte',
                'price' => 36300,
                'type' => 'coffee',
                'description' => 'Smooth espresso with steamed milk',
                'image_path' => 'https://images.unsplash.com/photo-1561882468-9110e03e0f78?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Hot Black (Americano)',
                'price' => 33000,
                'type' => 'coffee',
                'description' => 'Bold espresso with hot water',
                'image_path' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Flat White',
                'price' => 38500,
                'type' => 'coffee',
                'description' => 'Velvety microfoam over double espresso',
                'image_path' => 'https://images.unsplash.com/photo-1570968915860-54d5c301fa9f?auto=format&fit=crop&q=80&w=800',
            ],

            // COFFEE - Iced
            [
                'name' => 'Ice Black',
                'price' => 35200,
                'type' => 'coffee',
                'description' => 'Refreshing iced americano',
                'image_path' => 'https://images.unsplash.com/photo-1517487881594-2787fef5ebf7?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Ice White (Ice Latte)',
                'price' => 38500,
                'type' => 'coffee',
                'description' => 'Chilled espresso with cold milk',
                'image_path' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Ice Caramel Macchiato',
                'price' => 42000,
                'type' => 'coffee',
                'description' => 'Espresso with vanilla, milk, and caramel drizzle',
                'image_path' => 'https://images.unsplash.com/photo-1599639957043-f3aa5c986398?auto=format&fit=crop&q=80&w=800',
            ],

            // NON-COFFEE
            [
                'name' => 'Matcha Latte',
                'price' => 39000,
                'type' => 'non-coffee',
                'description' => 'Premium Japanese matcha with steamed milk',
                'image_path' => 'https://images.unsplash.com/photo-1536013564-f6b2c1c4f6c1?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Chocolate Hazelnut',
                'price' => 38000,
                'type' => 'non-coffee',
                'description' => 'Rich chocolate with hazelnut flavor',
                'image_path' => 'https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Vanilla Ice Cream Float',
                'price' => 35000,
                'type' => 'non-coffee',
                'description' => 'Creamy vanilla ice cream with soda',
                'image_path' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?auto=format&fit=crop&q=80&w=800',
            ],

            // FOOD - Pastry & Bakery
            [
                'name' => 'Butter Croissant',
                'price' => 28000,
                'type' => 'food',
                'description' => 'Flaky French butter croissant',
                'image_path' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Blueberry Cheesecake',
                'price' => 45000,
                'type' => 'food',
                'description' => 'Creamy New York style cheesecake with blueberry compote',
                'image_path' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?auto=format&fit=crop&q=80&w=800',
            ],

            // FOOD - Main Course
            [
                'name' => 'Margherita Pizza',
                'price' => 65000,
                'type' => 'food',
                'description' => 'Classic Italian pizza with fresh mozzarella and basil',
                'image_path' => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Aglio Olio Pasta',
                'price' => 55000,
                'type' => 'food',
                'description' => 'Spaghetti with garlic, olive oil, and chili flakes',
                'image_path' => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Classic Beef Burger',
                'price' => 58000,
                'type' => 'food',
                'description' => 'Juicy beef patty with lettuce, tomato, and special sauce',
                'image_path' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'name' => 'Nasi Goreng Special',
                'price' => 45000,
                'type' => 'food',
                'description' => 'Indonesian fried rice with chicken and fried egg',
                'image_path' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&q=80&w=800',
            ],
        ];

        foreach ($menus as $menuData) {
            Menu::create(array_merge($menuData, ['cafe_id' => $cafe->id]));
        }

        $this->command->info('✅ Coffee & Co. SOUL menu seeded successfully with ' . count($menus) . ' items.');
    }
}
