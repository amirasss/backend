<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $user =User::where('email',$request['email'])->first();

        if($user){
            $response['status']=0;
            $response['message']="Email aready exist";
            $response['code']=409;
        }
        else{
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password),


               ]);
               $response['status']=1;
               $response['message']="User Registered Successfuly";
               $response['code']=200;
        }


       return response()->json($response);
    }

    public function login(Request $request)
    {
        $credentials=$request->only('email','password');

        try {
            if(!JWTAuth::attempt($credentials)){
                $response['data']=null;
                $response['message']="Email Or Password incorrect";
                $response['code']=500;
                return response()->json($response);
            }
        } catch (JWTException $e) {
            $response['status']=0;
            $response['data']=null;
            $response['message']="Couldn't create token";
            $response['code']=500;
            return response()->json($response);


        }
        $user=auth()->user();
        $data['token']=auth()->claims([
            'user_id'=>$user->id,
            'email'=>$user->email
        ])->attempt($credentials);
            $response['data']=$data;
            $response['status']=1;
            $response['message']="Login Successfuly";
            $response['code']=200;
            return response()->json($response);

    }
}
