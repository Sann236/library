<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

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

        $path = 'public/image/books';
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
        $book->image = $request->image;
        $book->name = $request->name;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;
        $book->publisher_id = $request->publisher_id;
        $book->save();
        return redirect()->route('books');
    }

    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect()->route('books');
    }
}
