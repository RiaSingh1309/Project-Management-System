<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Project;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        $arr['members'] = Member::all();
        $arr['projects'] = Project::all();
        $arr['users'] = User::all();
        return view('home')->with($arr);
    }
}
