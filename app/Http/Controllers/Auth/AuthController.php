<?php

namespace App\Http\Controllers\Auth;

// Autentication and JWT
use Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

// Laravel
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Rules
use App\Http\Requests\User\LoginRequest;

class AuthController extends Controller
{
  // public function __construct() {
    //
  // }

  public function login(LoginRequest $request){
    // Data
    $_request = $request->all();
    $remenberMe = $request->only('remenber_me');
    $username = $_request['username'];

    // Verify type login
    if(filter_var($username, FILTER_VALIDATE_EMAIL)) $credentials = ['email' => $username, 'password' => $_request['password']];
    else $credentials = ['username' => $username, 'password' => $_request['password']];

    // Error
    if(!Auth::attempt($credentials)) return response()->json('Credenciales invalidas', 400);

    // Login success
    if (Auth::check()) $user = Auth::user();

    // Generate token
    try {
      $token = JWTAuth::attempt($credentials);
      info($token);
    }catch(JWTException $e){
       return response()->json('No se pudo crear el token', 500);
    }

    // Update Profile login
    $user->update($remenberMe);
    Auth::login($user);

    return response()->json(['user'=>$user, 'token'=>$token]);
  }

  public function logout(){
    info('before auth close');
    try {
      auth()->logout();
    } catch (\Throwable $th) {
        info($th->getMessage());      
      return response()->json($th->getMessage(), 500);

    }
    // info(Auth::logout());
    return response()->json('Te has deslogueado con exito', 200);
  }
}
