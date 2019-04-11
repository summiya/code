<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWishlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_wishlist', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned()->nullable();
            
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');

            $table->bigInteger('wishlist_id')->unsigned()->nullable();
            $table->foreign('wishlist_id')->references('id')
            ->on('wishlists')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_wishlist');
    }
}
