<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
        $password = $password = Hash::make( $request->password );
        $contact = $request->contact;
        $address = $request->address;
        $department = $request->department;
        $year = $request->year;
        $userImg = $request->file('userImg');

        $user = new User();

        $path = $userImg->store('users', 'public');

        $url = Storage::disk('public')->url($path);
         
        $user->name = $name;
        $user->enrollment = $enrollment;
        $user->email = $email;
        $user->password = $password;
        $user->contact = $contact;
        $user->address = $address;
        $user->department = $department;
        $user->year = $year;
        $user->userImg = $url;

        $user->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Student registered Successfully',
            $user,
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return response()->json([
                'status'=> 404,
                'message'=>'Email or password is not match',
                
            ]);
            
        }
        return response()->json([
            'status'=> 202,
            'message'=>'Login successfully',
            $user
        ]);
    }

}
