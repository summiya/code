<?php

use Illuminate\Database\Seeder;
use App\WishlistItems;
use App\Wishlist;

class WishlistItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        WishlistItems::truncate();

        $faker = \Faker\Factory::create();
        $wishlists = Wishlist::all()->pluck('id')->toArray();

        // And now, let's create a few Wishlist Items in our database:
        for ($i = 0; $i < 10; $i++) {
            WishlistItems::create([
                'name' => $faker->name,
                'description' => $faker->text,
                'image' => $faker->imageUrl($width = 200, $height = 200),
                'price' => $faker->randomNumber(3),
                'wishlist_id' => $faker->randomElement($wishlists)
            ]);
        }
    }
}
