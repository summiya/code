<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishlistItems extends Model
{
    protected $fillable = ['name', 'description', 'price', 'wishlist_id', 'image', 'url'];

    /**
     * Get the wishlist that owns the Item.
     */
    public function wishlist()
    {
        return $this->belongsTo('App\Wishlist');
    }
}
