<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    //
    public function index() {
        return view('publisher.index', [
            'publishers'=>Publisher::paginate(5)
        ]);
    }

    public function create() {
        return view('publisher.create');
    }

    public function store(StorePublisherRequest $request) {
        Publisher::create($request->validated());
        return redirect()->route('publishers');
    }

    public function edit(Publisher $publisher) {
        return view('publisher.edit', [
            'publisher'=>$publisher
        ]);
    }

    public function update(UpdatePublisherRequest $request, $id) {
       $publisher = Publisher::find($id);
       $publisher->name = $request->name;
       $publisher->save();

       return redirect()->route('publishers');
    }

    public function destroy($id) {
        Publisher::find($id)->delete();
        return redirect()->route('publishers');
    }
}

