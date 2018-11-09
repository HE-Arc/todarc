<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Project;
use App\Task;

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

    $projects = $user->projects;
    $organisations = $user->organisations;

    return view('userdashboard.dashboard', ['user' => $user, 'projects' => $projects, 'organisations' => $organisations]);
  }
}
