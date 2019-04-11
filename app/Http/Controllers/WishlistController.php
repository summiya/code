<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class WishlistController extends Controller
{
    public function index()
    {
    	// We are getting all wishlist for currently loggedin user
    	// Replace user_id with loggedin User Id
        $user = JWTAuth::parseToken()->toUser()->id;
        $wishlists = Wishlist::with(['user','wishlistItems'])->where('user_id', $user)->get();
        return $wishlists;
    }

    public function show(Wishlist $wishlist) {
        return $wishlist;
    }

    public function store(Request $request)
    {
        $wishlist = Wishlist::create($request->all());

        return response()->json($wishlist, 201);
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        $wishlist->update($request->all());

        return response()->json('Wishlist updated successfully', 200);
    }

    public function delete(Wishlist $wishlist)
    {
        $wishlist->delete();

        return response()->json(null, 204);
    }

    public function share(Request $request, Wishlist $wishlist)
    {
        $user = $request->selectedUser['id'];
        // check if wishlist is not assigned before
        if ($wishlist->users->contains($user))
        {
          return response()->json('Wishlist already shared with this user', 400);

        } else {
          $wishlist->users()->attach($user);
          return response()->json('Wishlist Shared successfully', 200);
        }
    }
}
