<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\IssuedResources;
use Illuminate\Support\Facades\Storage;

class IssuedResourcesController extends Controller
{
    public function showIssuedResource()
    {
        $issuedresources = IssuedResources::all();
        return response()->json([
            'status'=> 200,
            'iissuedresources'=>$issuedresources,
        ]);
    }

    public function createIssuedResources(Request $request)
    {
        $title = $request->title;
        $image = $request->image;
        $userEmail = $request->userEmail;
        $userName = $request->userName;
        $from = $request->from;
        $to = $request->to;

       
        $issuedresources = new IssuedResources();
         
        $issuedresources->title = $title;
       
      
        $issuedresources->image = $image;
        $issuedresources->userEmail = $userEmail;
      
        $issuedresources->userName = $userName;
        $issuedresources->from = $from;
        $issuedresources->to = $to;

        $issuedresources->save();

        return response()->json([
            'status'=> 200,
            'message'=>'issuedresources',
             $issuedresources,
        ]);
    }

    public function searchByUserEmail($userEmail)
    {
        $issuedresources = IssuedResources::where("userEmail", $userEmail)->get();
        if (count($issuedresources) > 0) {
            return response()->json([
                'status'=> 200,
                'issuedresources' => $issuedresources
            ]);
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found on issuedbook',
                    ]);
        }
    }

    public function destroy($id)
    {

        $issuedresources = IssuedResources::find($id);
        if($issuedresources)
        {
            $issuedresources->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Accepted Succcessfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No ID Found',
            ]);
        }
    }


}
