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

        $pathh = parse_url($url, PHP_URL_PATH);
         
        $book->title = $title;
        $book->author = $author;
        $book->description = $description;
        $book->category = $category;
        $book->noofbook = $noofbook;
        $book->image = $pathh;

        $book->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Book stored Successfully',
             $book,
            
        ]);
    }


    public function searchByCaterory($category)
    {

        $books = Books::where("category", $category)->get();

        if (count($books) > 0) {
            return $books;
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found',
                    ]);
        }

        
    }

    public function searchByName($title)
    {

        $b = Books::where("title", 'like', '%'.$title.'%')->get();

        if (count($b) > 0) {
            return response()->json([
                'status'=> 200,
                'books'=>$b,
            ]);
        }
        else {
            return response()->json([
                        'status'=> 404,
                        'message' => 'No Book Found',
                    ]);
        }
    }

    public function destroy($id)
    {

        $books = Books::find($id);
        if($books)
        {
            $books->delete();
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


    public function update(Request $request, $id)
    {
        $books = Books::find($id);
        $books->update($request->all());
        return $books;
    }
}
