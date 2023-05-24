<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Student;
use Dotenv\Validator;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        if ($students->count() > 0){
        $data = [
            'status'=>200,
            'students'=>$students
        ];
        return response()->json($data, 200);
    }else{
            $data = [
                'status'=>404,
                'message'=>'Nie znaleziono'
            ];
            return response()->json($data, 404);
        }

    }
    public function store(Request $request){
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
        'name' => 'required|string|max:191',
        'email' => 'required|email|max:191',
        'phone' => 'required|digits:9',
        'gender' => 'required|string|max:191'
    ]);
    if ($validator->fails()){
        return response()->json([
            'status'=>422,
            'errors'=>$validator->messages()
        ], 422);
    }else{
        $student = Student::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'phone' =>$request->phone,
            'gender' =>$request->gender,
        ]);
        if ($student){
            return response()->json([
                'status'=>200,
                'message'=>"Student stworzony prawidlowo"
            ],200);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"Cos poszlo nie tak"
            ],500);
        }
    }
    }

    public function show($id){
        $student=Student::find($id);
        if ($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"Nie znaleziono studenta"
            ],404);
        }
    }
    public function edit($id){
        $student=Student::find($id);
        if ($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"Nie znaleziono studenta"
            ],404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9',
            'gender' => 'required|string|max:191'
        ]);
        if ($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ], 422);
        }else{
            $student = Student::find($id);

            if ($student){
                $student -> update([
                    'name' =>$request->name,
                    'email' =>$request->email,
                    'phone' =>$request->phone,
                    'gender' =>$request->gender,
                ]);
                return response()->json([
                    'status'=>200,
                    'message'=>"Student zaktualizowany poprawnie"
                ],200);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>"Nie znaleziono studenta"
                ],404);
            }
        }
    }

    public function destroy($id){
        $student = Student::find($id);
        if ($student){
            $student->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Student usuniety"
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"Nie znaleziono studenta"
            ],404);
        }
    }
}
