<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Books;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function show()
    {
        $book = Books::all();
        return response()->json([
            'status'=> 200,
            'books'=>$book,
        ]);
    }

    public function create(Request $request)
    {
        $title = $request->title;
        $author = $request->author;
        $description = $request->description;

        $category = $request->category;
        $noofbook = $request->noofbook;

        $image = $request->file('image');

        $book = new Books();

        $path = $image->store('books', 'public');

        $url = Storage::disk('public')->url($path);
         
        $book->title = $title;
        $book->author = $author;
        $book->description = $description;
        $book->category = $category;
        $book->noofbook = $noofbook;
        $book->image = $url;

        $book->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Book stored Successfully',
            $book,
        ]);
    }
}
