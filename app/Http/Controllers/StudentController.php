<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
    }

    public function fetchStudents()
    {
        $student = Student::all();

        return response()->json([
            'students' => $student,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'required|max:200',
            'course' => 'required|max:200',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages(),
            ]);
        } else {
            $student = new Student;
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->course = $request->input('course');
            $student->save();
            return response()->json([
                'status' => 200,
                'message' => 'Student was added successfully'
            ]);
        }
    }

    //a function to edit student
    public function edit($id)
    {
        $std = Student::find($id);

        if ($std) {
            return response()->json([
                'status' => 200,
                'message' => 'student was found',
                'student' => $std
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'student not found'
            ]);
        }
    }

    //function to update student details to the database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'required|max:200',
            'course' => 'required|max:200',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->messages(),
            ]);
        } else {
            $student = Student::find($id);

            if ($student) {
                $student->name = $request->input('name');
                $student->email = $request->input('email');
                $student->phone = $request->input('phone');
                $student->course = $request->input('course');
                $student->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Student was updated successfully'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'student not found'
                ]);
            }
        }
    }

    //a function to delete a student data from the database
    public function deleteStudent($id){
        $student = Student::find($id);
        $student->delete();
        return response()->json([
            'status' => 200,
            'message' => 'student deleted successfully'
        ]);
    }
}
