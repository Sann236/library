<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function index()
    {
        return view('book.index', [
            'books' => Book::paginate(5)
        ]);
    }

    public function create()
    {
        return view('book.create', [
            'authors' => Author::latest()->get(),
            'publishers' => Publisher::latest()->get(),
            'categories' => Category::latest()->get(),
        ]);
    }

    public function store(StoreBookRequest $request)
    {

        $path = 'public/images/books';
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $image->storeAs($path, $image_name);

        $book = new Book();
        $book->image = $image_name;
        $book->name = $request->name;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->status = 'Y';
        $book->save();



        // Book::create($request->validated() + [
        //     'status' => 'Y'
        // ]);
        return redirect()->route('books');
    }

    public function edit(Book $book)
    {
        return view('book.edit', [
            'authors' => Author::latest()->get(),
            'publishers' => Publisher::latest()->get(),
            'categories' => Category::latest()->get(),
            'book' => $book
        ]);
    }


    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::find($id);
        $book->name = $request->name;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;

        if ( $request->hasFile("image")) {
            Storage::delete("public/images/books/".$book->image);

            // $newName = uniqid()."_book.".$request->file("image")->extension();
            $newName = $request->file('image')->getClientOriginalName();

            $request->file("image")->storeAs("public/images/books", $newName);

            $book->image = $newName;
        }

        $book->update();


        // $book->name = $request->name;
        // $book->author_id = $request->author_id;
        // $book->category_id = $request->category_id;
        // $book->publisher_id = $request->publisher_id;

        // if ($request->hasFile('image')) {
        //     $destination = 'public/images/books/' . $book->image;
        //     if (File::exists($destination)) {
        //         File::delete($destination);
        //     }
        //     $image = $request->file('image');
        //     $image_name = $image->getClientOriginalName();
        //     $image->storeAs('public/images/books', $image_name);
        //     $book->image = $image_name;
        // }

        
        
        $book->save();
        return redirect()->route('books');
    }

    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect()->route('books');
    }
}
