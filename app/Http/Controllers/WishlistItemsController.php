<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\WishlistItems;
use App\Wishlist;
use JWTAuth;

class WishlistItemsController extends Controller
{
    public function index(Wishlist $wishlist)
    {
    	//dd($wishlist);
    	// We are getting all wishlist Items Based on Wishlist
        $user = JWTAuth::parseToken()->toUser()->id;
        $wishlistItems = WishlistItems::with('wishlist')->where('wishlist_id', $wishlist->id)->get();
        return $wishlistItems;
    }

    public function show(WishlistItems $item) {
        return $item;
    }

    public function store(Request $request)
    {
        $wishlistItems = WishlistItems::create($request->all());

        return response()->json($wishlistItems, 201);
    }

    public function update(Request $request, WishlistItems $item)
    {
        $item->update($request->all());

        return response()->json('Wishlist Item updated successfully', 200);
    }

    public function delete(WishlistItems $item)
    {
        $item->delete();

        return response()->json(null, 204);
    }
}
