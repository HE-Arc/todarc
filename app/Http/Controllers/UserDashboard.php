<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;

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
    // TODO Update to index
    $user = Auth::user();

    $projects = $user->projects()->get();
    $organisations = $user->organisations()->get();

    return view('userdashboard.dashboard', ['projects' => $projects, 'organisations' => $organisations]);
  }
}
