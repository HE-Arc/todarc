<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
  *
  * @var string
  */
  protected $redirectTo = '/home';

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function login(Request $request)
  {
    $credentials = $request->only($this->username(), 'password');
    $authSuccess = Auth::attempt($credentials, $request->has('remember'));

    if($authSuccess)
    {
      $request->session()->regenerate();
      return response(['success' => true], Response::HTTP_OK)->json(['redirectTo' => $this->redirectTo]);
    }

    return response(
    [
      'success' => false,
      'message' => 'Auth failed (or some other message)'
    ], Response::HTTP_FORBIDDEN);
  }
}
