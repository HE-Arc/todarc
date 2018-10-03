<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
    $authSuccess = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->input('remember'));

    if($authSuccess)
    {
      $request->session()->regenerate();
      return response(['success' => true, 'redirectTo' => $this->redirectTo], Response::HTTP_OK);
    }
    else
    {
      return response(
      [
        'success' => false,
        'message' => 'Auth failed'
      ], Response::HTTP_FORBIDDEN);
    }

  }
}
