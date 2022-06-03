<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Storage;

class WishlistController extends Controller
{
    public function createWishlist(Request $request)
    {
        $title = $request->title;
        $author = $request->author;
        $category = $request->category;
        // $image = $request->file('image');
        $image = $request->image;
        $userEmail = $request->userEmail;
        $userEnrollment = $request->userEnrollment;
        $userName = $request->userName;

        $wishlist = new Wishlist();

        // $path = $image->store('wishlistBooks', 'public');

        // $url = Storage::disk('public')->url($path);
         
        $wishlist->title = $title;
        $wishlist->author = $author;
        $wishlist->category = $category;
        $wishlist->image = $image;
        $wishlist->userEmail = $userEmail;
        $wishlist->userEnrollment = $userEnrollment;
        $wishlist->userName = $userName;

        $wishlist->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Wishlists',
             $wishlist,
        ]);
    }

    public function searchByUserEmail($userEmail)
    {
        $wishlist = wishlist::where("userEmail", $userEmail)->get();
        if (count($wishlist) > 0) {
            return response()->json([
                'status'=> 200,
                'wishlist' => $wishlist
            ]);
            
            
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found on Wishlist',
                    ]);
        }
    }


    public function destroy($id)
    {

        $wishlist = wishlist::find($id);
        if($wishlist)
        {
            $wishlist->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'book Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No book ID Found',
            ]);
        }
    }
}
