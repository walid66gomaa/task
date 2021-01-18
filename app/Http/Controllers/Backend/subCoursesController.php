<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Course;
use App\Http\Controllers\Controller;

class subCoursesController extends Controller
{
    public function subscripeCourses()
    {
        $subPackages=auth()->user()->subscripPackageItems;
        $hasActivePackage=false;
        foreach($subPackages as $subPackage)
        {
            if (Carbon::parse($subPackage->start_date)->addMonths($subPackage->duration) >= Carbon::now()) {
                $hasActivePackage=true;
                break;
            } 
        }


        if($hasActivePackage)
        {
            $courses = Course::where('published', 1)->orderBy('id', 'desc')->paginate(9);

        }
       
        
        return view('backend.subscripeCourses.index',compact('courses','hasActivePackage','subPackages'));
        

    }

}
