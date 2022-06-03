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

        $pathh = parse_url($url, PHP_URL_PATH);
         
        $resources->title = $title;
        $resources->description = $description;
        $resources->image = $pathh;

        $resources->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Resource stored Successfully',
             $resources,
        ]);
    }

    public function destroy($id)
    {

        $resources = Resources::find($id);
        if($resources)
        {
            $resources->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Resources Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Resources ID Found',
            ]);
        }
    }


}
