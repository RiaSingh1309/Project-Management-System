<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Member;
use App\Project;
use Session;

class MembersController extends Controller
{
    public function index()
    {
        $members = Member::sortable()->paginate(4);
        return view('admin.members.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Member $member)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'doj' => 'required'            
        ];
    
        $customMessages = [
            'name.required' => '*Please enter the member name',
            'email.required' => '*Please enter the email id of the member',
            'doj.required'  => '*Kindly choose a date of joining'                        
        ];

        $this->validate($request, $rules, $customMessages);

        $member->name = $request->name;
        $member->email = $request->email;
        $member->doj = $request->doj;
        $member->save();
        Session::flash('success','Member details added successfully');
        return redirect()->route('admin.members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $arr['member'] = $member;
        return view('admin.members.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'doj' => 'required'            
        ];
    
        $customMessages = [
            'name.required' => '*Please enter the member name',
            'email.required' => '*Please enter the email id of the member',
            'doj.required'  => '*Kindly choose a date of joining'                        
        ];

        $this->validate($request, $rules, $customMessages);
        
        $member->name = $request->name;
        $member->email = $request->email;
        $member->doj = $request->doj;
        $member->save();
        Session::flash('success','Member details updated successfully');
        return redirect()->route('admin.members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::destroy($id);
        foreach (Project::all() as $project)
        {
            $project->member()->detach($id);
        }
        Session::flash('success','Member details deleted successfully');
        return redirect()->route('admin.members.index');
    }
}
