<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    //
    public function index() {
        return view('student.index', [
            'students'=>Student::paginate(5)
        ]);
    }

    public function create() {
        return view('student.create');
    }

    public function store(StoreStudentRequest $request) {
        Student::create($request->validated());
        return redirect()->route('students');
    }

    public function edit(Student $student) {
        return view('student.edit', [
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, $id) {
        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        
        $student->update();

        return redirect()->route('students');
    }

    public function destroy($id) {
        Student::find($id)->delete();
        return redirect()->route('students');
    }
}
