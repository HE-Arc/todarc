<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class JsonUserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return response()->json(User::all());
  }
}
