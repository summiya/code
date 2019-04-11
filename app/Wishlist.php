<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['name', 'user_id', 'sharable_link'];

    /**
     * Get the user that owns the wishlist.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the wishlist Items for the user.
     */
    public function wishlistItems()
    {
        return $this->hasMany('App\WishlistItems');
    }

    /**
     * Get all the users with which wishlist is shared
     */
    public function users()
    {
        return $this->belongsToMany('App\User')
          ->withTimestamps();
    }
}
