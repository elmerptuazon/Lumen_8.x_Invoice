<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if(!$user){
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'api_key' => ''
            ]);
            return response()->json(['status' => 'success'], 200);
        }else{
            return response()->json(['status' => 'fail'],401);
        }
  
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if(Hash::check($request->input('password'), $user->password) && $user->email === $request->input('email')){
            $apikey = base64_encode(Str::random(40));
            User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);
            return response()->json(['status' => 'success','api_key' => $apikey]);
        }else{
            return response()->json(['status' => 'fail'],401);
        }
    }

    public function logout(Request $request) {
        $authCheck = $this->authUser($request->header('Authorization'));
        if(!$authCheck) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $this->validate($request, [
            'id' => 'required',
        ]);

        $user = User::where('id', $request->input('id'))->first();

        if($user) {
            User::where('id', $request->input('id'))->update(['api_key' => ""]);
            return response()->json(['status' => 'success'], 200); 
        }else {
            return response()->json(['status' => 'fail'],401);
        }

    }
}
