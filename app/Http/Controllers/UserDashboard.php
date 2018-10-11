<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboard extends Controller
{
  /**
   * Display the view of the user of the dashboard
   *
   * @param $request
   * @param $userName formatted username to find it back in the database
   * @return view of the dashboard
   */
    public function dashboard(Request $request)
    {
      return view('userdashboard.dashboard');
    }
}
