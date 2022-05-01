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

        
        $ebook = new Ebook();
        
        $path = $image->store('ebooks', 'public');

        $url = Storage::disk('public')->url($path);
         
        $ebook->title = $title;
        $ebook->author = $author;
        $ebook->description = $description;
        $ebook->category = $category;
        $ebook->size = $size;
        $ebook->pages = $pages;
        $ebook->image = $url;

        $ebook->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Ebook stored Successfully',
            $ebook,
        ]);
    }
}
