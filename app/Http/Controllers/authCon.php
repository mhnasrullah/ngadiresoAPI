<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class authCon extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        // $credentials = $request->only('email', 'password');

        // $token = Auth::attempt($credentials);
        if (!$token = auth()->attempt($request->all())) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        return $this->responseToken($token);

        // $user = Auth::user();
        // return response()->json([
        //         'status' => 'success',
        //         'user' => $user,
        //         'authorisation' => [
        //             'token' => $token,
        //             'type' => 'bearer',
        //         ]
        //     ]);

    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            // 'authorisation' => [
            //     'token' => $token,
            //     'type' => 'bearer',
            // ]
        ]);
    }

    public function responseToken($token){
        return response()->json([
            'access_token' => $token,
            'type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL()*60
        ]);
    }


    // public function logout()
    // {
    //     Auth::logout();
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Successfully logged out',
    //     ]);
    // }

    public function refresh()
    {
        // return response()->json([
        //     'status' => 'success',
        //     'user' => Auth::user(),
        //     'authorisation' => [
        //         'token' => Auth::refresh(),
        //         'type' => 'bearer',
        //     ]
        // ]);

        return $this->responseToken(auth()->refresh());
    }

    public function user(){
        return auth()->user();
    }

    public function logout(){
        auth()->logout();
        return response()->json([
            'message' => 'successfully logout'
        ]);
    }
}
