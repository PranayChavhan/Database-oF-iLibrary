<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\WaitingListController;
use Illuminate\Support\Facades\Storage;

class WaitingListControllerController extends Controller
{
    public function showWaitingList()
    {
        $issuedbook = WaitingListController::all();
        return response()->json([
            'status'=> 200,
            'WaitingList'=>$issuedbook,
        ]);
    }
    public function createWaitingList(Request $request)
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

        $issuedbook = new WaitingListController();

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
             $issuedbook,
        ]);
    }

    public function destroy($id)
    {

        $issuedbook = WaitingListController::find($id);
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
