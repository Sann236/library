<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookIssueRequest;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Settings;
use App\Models\Student;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    //
    public function index()
    {
        return view('book.issueBooks', [
            'books' => BookIssue::paginate(5)
        ]);
    }

    public function create()
    {
        return view('book.issueBook_add', [
            'students' => Student::latest()->get(),
            'books' => Book::where('status', 'Y')->get(),
        ]);
    }

    public function store(StoreBookIssueRequest $request)
    {
        $issue_date = date('Y-m-d');
        $return_date = date('Y-m-d', strtotime("+" . (Settings::latest()->first()->return_days) . " days"));
        $data = BookIssue::create($request->validated() + [
            'student_id' => $request->student_id,
            'book_id' => $request->book_id,
            'issue_date' => $issue_date,
            'return_date' => $return_date,
            'issue_status' => 'N',
        ]);
        $data->save();
        $book = Book::find($request->book_id);
        $book->status = 'N';
        $book->save();
        return redirect()->route('book_issued');
    }


    public function edit($id)
    {
        // calculate the total fine  (total days * fine per day)
        $book = BookIssue::where('id',$id)->get()->first();
        $first_date = date_create(date('Y-m-d'));
        $last_date = date_create($book->return_date);
        $diff = date_diff($first_date, $last_date);
        $fine = (Settings::latest()->first()->fine * $diff->format('%a'));
        return view('book.issueBook_edit', [
            'book' => $book,
            'fine' => $fine,
        ]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $book = BookIssue::find($id);
        $book->issue_status = 'Y';
        $book->return_day = now();
        $book->save();
        $bookk = Book::find($book->book_id);
        $bookk->status= 'Y';
        $bookk->save();
        return redirect()->route('book_issued');
    }

    public function destroy($id)
    {
        BookIssue::find($id)->delete();
        return redirect()->route('book_issued');
    }
}
