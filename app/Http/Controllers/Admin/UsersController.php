<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Project;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['users'] = User::sortable()->paginate(4);
        $arr['projects'] = Project::all();
        return view('admin.users.index')->with($arr);
    }
}
