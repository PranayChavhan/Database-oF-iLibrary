<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Resources;
use Illuminate\Support\Facades\Storage;

class ResourcesController extends Controller
{
    public function show()
    {
        $resources = Resources::all();
        return response()->json([
            'status'=> 200,
            'resources'=>$resources,
        ]);
    }

    public function create(Request $request)
    {
        $title = $request->title;
        $description = $request->description;

        $image = $request->file('image');

        $resources = new Resources();

        $path = $image->store('resources', 'public');

        $url = Storage::disk('public')->url($path);
         
        $resources->title = $title;
        $resources->description = $description;
        $resources->image = $url;

        $resources->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Resource stored Successfully',
             $resources,
        ]);
    }
}
