<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\Teachers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeachersController extends Controller
{
    public function showTeacher()
    {
        $teachers = Teachers::all();
        return response()->json([
            'status'=> 200,
            'teachers'=>$teachers,
        ]);
    }

    public function createTeacher(Request $request)
    {
        $name = $request->name;
        $teacher_id = $request->teacher_id;
        $password = $password = Hash::make( $request->password );
        $contact = $request->contact;
        $address = $request->address;
        $department = $request->department;
        $teacherImg = $request->file('teacherImg');

        $teacher = new Teachers();

        $path = $teacherImg->store('teacher', 'public');

        $url = Storage::disk('public')->url($path);

        $pathh = parse_url($url, PHP_URL_PATH);
         
        $teacher->name = $name;
        $teacher->teacher_id = $teacher_id;
        $teacher->password = $password;
        $teacher->contact = $contact;
        $teacher->address = $address;
        $teacher->department = $department;
        $teacher->teacherImg = $pathh;

        $teacher->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Teacher registered Successfully',
            $teacher,
        ]);
    }

    public function login(Request $request)
    {
        $teacher = Teachers::where('teacher_id', $request->teacher_id)->first();
        if(!$teacher || !Hash::check($request->password, $teacher->password))
        {
            return response()->json([
                'status'=> 404,
                'message'=>'Email or password is not match',
                
            ]);
        }
        return response()->json([
            'status'=> 202,
            'message'=>'Login successfully',
            'teachers'=>$teacher,
        ]);
    }

    public function destroy($id)
    {

        $teacher = Teachers::find($id);
        if($teacher)
        {
            $teacher->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Teacher Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Teacher ID Found',
            ]);
        }
    }




}
