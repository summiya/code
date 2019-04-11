# Wishlist Application

## Quick Installation

#### Pre-requisites
Create a Database of any name and rename file .env-example to .env and configure database and other configurations

##### Download this project to your local system`

##### Go to wishlist Directory
`cd wishlist`

##### Install all dependencies
`composer install`

##### Run migrations to create tables into your database
`php artisan migrate`

##### Then Run the following migrations
`php artisan db:seed --class=WishlistTableSeeder`

`php artisan db:seed --class=WishlistItemsTableSeeder`

##### See the project in action at http://localhost:8000
`php artisan serve`