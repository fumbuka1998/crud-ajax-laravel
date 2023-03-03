<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        return view('student.index');
    }

    public function fetchStudents(){
        $student = Student::all();

        return response()->json([
            'students'=>$student,
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required|max:200',
            'email'=>'required|email|max:200',
            'phone'=>'required|max:200',
            'course'=>'required|max:200',
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'error'=>$validator->messages(),
            ]);
        }
        else{
            $student = new Student;
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->course = $request->input('course');
            $student->save();
            return response()->json([
                'status'=>200,
                'message'=>'Student was added successfully'
            ]);
        }

    }
}
