<?php

use Illuminate\Database\Seeder;
use App\Wishlist;

class WishlistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        // Wishlist::truncate();
        // WishlistItems::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few Wishlists in our database:
        for ($i = 0; $i < 10; $i++) {
            Wishlist::create([
                'name' => $faker->name,
                'user_id' => factory('App\User')->create()->id
            ]);
        }
    }
}
