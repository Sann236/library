<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class AuthorController extends Controller
{
    //
    public function index() {
        return view('author.index',[
            'authors' => Author::paginate(5)
        ]);
    }

    public function create() {
        return view('author.create');
    }

    public function store(StoreAuthorRequest $request) {
        Author::create($request->validated());

        return redirect()->route('authors');
    }

    public function edit(Author $author){
        return view('author.edit', [
            'author'=>$author
        ]);
    }

    public function update(UpdateAuthorRequest $request, $id) {
        $author = Author::find($id);
        $author->name = $request->name;
        $author->save();

        return redirect()->route('authors');
    }

    public function destroy($id) {
        Author::find($id)->delete();

        return redirect()->route('authors');
    }
}
