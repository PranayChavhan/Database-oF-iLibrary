<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    

    public function showUser()
    {
        $user = User::all();
        return response()->json([
            'status'=> 200,
            'students'=>$user,
        ]);
    }

    public function createUser(Request $request)
    {
        $name = $request->name;
        $enrollment = $request->enrollment;
        $email = $request->email;
        $password =$request->password;
        $contact = $request->contact;
        $address = $request->address;
        $department = $request->department;
        $year = $request->year;
        // $userImg = $request->file('userImg');
        $userImg = $request->userImg;
        

        $user = new User();

        // $path = $userImg->store('users', 'public');

        // $url = Storage::disk('public')->url($path);
         
        $user->name = $name;
        $user->enrollment = $enrollment;
        $user->email = $email;
        $user->password = $password;
        $user->contact = $contact;
        $user->address = $address;
        $user->department = $department;
        $user->year = $year;
        // $user->userImg = $url;
        $user->userImg = $userImg;
        

        $user->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Student registered Successfully',
            $user,
        ]);
    }

    public function loginAdmin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = new User();

        $user->email = $email;
        $user->password = $password;

        if ($email == "hello@gmail.com" && $password == "Pass@123") {
            return response()->json([
                'status'=> 202,
                'message'=>'Login successfully',
                'students'=>$user,
            ]);
        } else {
            return response()->json([
                'status'=> 404,
                'message'=>'Email or password is not match',
                
            ]);
        }

    }


    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || !($request->password == $user->password))
        {
            return response()->json([
                'status'=> 404,
                'message'=>'Email or password is not match',
                
            ]);
        }
        return response()->json([
            'status'=> 202,
            'message'=>'Login successfully',
            'students'=>$user,
        ]);
    }


    

    public function changePassword(Request $request, $id,)
    {
        $user = User::find($id);

        $cpass = $request->cpass;

        $pass = $user->password;

        if ($cpass == $pass) {
            $user->update($request->all());
            return response()->json([
                'status'=> 202,
                'message' => $user,
            ]);

        } else {
            return response()->json([
                'status'=> 404,
                'message' => 'No user Found',
            ]);;
        }

    }

    public function destroy($id)
    {

        $user = User::find($id);
        if($user)
        {
            $user->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Student Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Student ID Found',
            ]);
        }
    }



}
