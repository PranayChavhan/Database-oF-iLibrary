<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\AcceptBook;
use Illuminate\Support\Facades\Storage;

class AcceptBookController extends Controller
{
    public function acceptbook(Request $request)
    {
        $title = $request->title;
        $userEnrollment = $request->userEnrollment;
        $image = $request->image;
        $id = $request->id;

        $book = new AcceptBook();
         
        $book->title = $title;
        $book->userEnrollment = $userEnrollment;
        $book->image = $image;
        
        $book->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Book stored Successfully',
             $book,
        ]);
    }

    public function searchByEnrollment($userEnrollment)
    {

        $book = AcceptBook::where("userEnrollment", $userEnrollment)->get();

        if (count($book) > 0) {
            return response()->json([
                'status'=> 200,
                'books'=>$book,
            ]);
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found',
                    ]);
        }
        
    }
}

