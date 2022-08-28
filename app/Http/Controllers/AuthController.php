<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $response = array('response' => '', 'success'=>false);
        $res = Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        if($res){
            $user = User::find(auth()->user()->id);
            $token = $user->createToken('vedscienceToken')->plainTextToken;
            $response['response'] =["user"=>$user,"token"=>$token];
            $response['success'] = true;
            return $response;
        } 
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return ["message" => "Logged out"];
    }
}

// 5|Wyp9m2PsADswGYmpInUCo6yeHUdZ0zptEGONdroW
