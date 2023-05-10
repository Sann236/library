<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index() {
        return view('category.index', [
            'categories'=>Category::paginate(5)
        ]);
    }

    public function create() {
        return view('category.create');
    }

    public function store(StoreCategoryRequest $request) {
        Category::create($request->validated());
        return redirect()->route('categories');
    }
    public function edit(Category $category) {
        return view('category.edit', [
            'category'=>$category
        ]);
    }

    public function update(UpdateCategoryRequest $request, $id) {
        $category = Category::find($id);
        $category->name = $request->name;

        $category->update();

        return redirect()->route('categories');
    }

    public function destroy($id) {
        Category::find($id)->delete();
        return redirect()->route('categories');
    }
}
