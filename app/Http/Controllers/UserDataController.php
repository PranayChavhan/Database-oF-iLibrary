<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Models\UserData;
use Illuminate\Support\Facades\Storage;

class UserDataController extends Controller
{
    public function showUser()
    {
        $user = UserData::all();
        return response()->json([
            'status'=> 200,
            'books'=>$user,
        ]);
    }

    public function createUser(Request $request)
    {
        $name = $request->name;
        $enrollment = $request->enrollment;
        $email = $request->email;
        $contact = $request->contact;
        $address = $request->address;
        $department = $request->department;
        $year = $request->year;
        $userImg = $request->file('userImg');

        $user = new UserData();

        $path = $userImg->store('users', 'public');

        $url = Storage::disk('public')->url($path);
         
        $user->name = $name;
        $user->enrollment = $enrollment;
        $user->email = $email;
        $user->contact = $contact;
        $user->address = $address;
        $user->department = $department;
        $user->year = $year;
        $user->userImg = $userImg;

        $user->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Book stored Successfully',
            $user,
        ]);
    }
}
