<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;


/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    private $path;

    public function __construct()
    {


    }

    public function index()
    {
       

 
        return view( 'frontend.index' );
     }

}

