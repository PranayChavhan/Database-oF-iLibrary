<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\IssuedBook;
use Illuminate\Support\Facades\Storage;

class IssuedBookController extends Controller
{

    public function showIssuedBook()
    {
        $issuedbook = IssuedBook::all();
        return response()->json([
            'status'=> 200,
            'issuedbook'=>$issuedbook,
        ]);
    }


    public function createIssuedBook(Request $request)
    {
        $title = $request->title;
        $author = $request->author;
        $category = $request->category;
        $image = $request->image;
        $userEmail = $request->userEmail;
        $userEnrollment = $request->userEnrollment;
        $userName = $request->userName;
        $userName = $request->userName;
        $status = $request->status;

        $issuedbook = new IssuedBook();

        // $path = $image->store('wishlistBooks', 'public');

        // $url = Storage::disk('public')->url($path);
         
        $issuedbook->title = $title;
        $issuedbook->author = $author;
        $issuedbook->category = $category;
        $issuedbook->image = $image;
        $issuedbook->userEmail = $userEmail;
        $issuedbook->userEnrollment = $userEnrollment;
        $issuedbook->userName = $userName;
        $issuedbook->status = $status;

        $issuedbook->save();

        return response()->json([
            'status'=> 200,
            'message'=>'issuedbook',
             $issuedbook,
        ]);
    }

    public function searchByUserEmail($userEmail)
    {
        $issuedbook = issuedbook::where("userEmail", $userEmail)->get();
        if (count($issuedbook) > 0) {
            return response()->json([
                'status'=> 200,
                'issuedbook' => $issuedbook
            ]);
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found on issuedbook',
                    ]);
        }
    }
    public function searchByStatus($status)
    {
        $issuedbook = issuedbook::where("userEmail", $userEmail)->get();
        if (count($issuedbook) > 0) {
            return response()->json([
                'status'=> 200,
                'issuedbook' => $issuedbook
            ]);
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found on issuedbook',
                    ]);
        }
    }

    public function updateBook(Request $request, $id,)
    {
        $issuedbook = IssuedBook::find($id);

        if ($issuedbook) {
            $issuedbook->update($request->all());
            return response()->json([
                'status'=> 202,
                'message' => $issuedbook,
            ]);

        } else {
            return response()->json([
                'status'=> 404,
                'message' => 'No user Found',
            ]);;
        }

    }


    public function destroy($id)
    {

        $issuedbook = IssuedBook::find($id);
        if($issuedbook)
        {
            $issuedbook->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Book Deleted Successfully',
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
