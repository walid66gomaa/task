<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;


/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
       
        if (\Auth::check()) {

           
     if(auth()->user()->hasRole('administrator')){
                $users_count = User::role('user')->count();
              
            }
        }

        return view('backend.dashboard',compact('users_count'));
    }
}
