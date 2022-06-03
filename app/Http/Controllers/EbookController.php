<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use File;
use App\Models\Ebook;
use Illuminate\Support\Facades\Storage;


class EbookController extends Controller
{
    public function showebook()
    {
        $ebook = Ebook::all();
        return response()->json([
            'status'=> 200,
            'ebooks'=>$ebook,
        ]);
    }

    public function createebook(Request $request)
    {
        $title = $request->title;
        $author = $request->author;
        $description = $request->description;

        $category = $request->category;
        $size = $request->size;
        $pages = $request->pages;

        $image = $request->file('image');
        $bookimg = $request->file('bookimg');

        
        $ebook = new Ebook();
        
        $path = $image->store('ebooks', 'public');

        $url = Storage::disk('public')->url($path);

        $pathh = parse_url($url, PHP_URL_PATH);


        $imagepath = $bookimg->store('ebooks image', 'public');

        $imageurl = Storage::disk('public')->url($imagepath);

        $pathhh = parse_url($imageurl, PHP_URL_PATH);
         
        $ebook->title = $title;
        $ebook->author = $author;
        $ebook->description = $description;
        $ebook->category = $category;
        $ebook->size = $size;
        $ebook->pages = $pages;
        $ebook->image = $pathh;
        $ebook->bookimg = $pathhh;

        $ebook->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Ebook stored Successfully',
            $ebook,
        ]);
    }

    public function destroy($id)
    {

        $ebook = Ebook::find($id);
        if($ebook)
        {
            $ebook->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Ebook Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Ebook ID Found',
            ]);
        }
    }

    public function searchByCaterory($category)
    {

        $ebook = Ebook::where("category", $category)->get();

        if (count($ebook) > 0) {
            return $ebook;
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found',
                    ]);
        }

        
    }


}
