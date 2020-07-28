<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Member;
use App\User;
use Carbon\Carbon;
use Session;

class ProjectsController extends Controller
{
    public function index()
    {        
        $projects = Project::sortable()->paginate(4);
        return view('admin.projects.index',compact('projects'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['users'] = User::all();
        $arr['members'] = Member::all();
        return view('admin.projects.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Project $project)
    {
        if($request->project_start > Carbon::now()->toDateTimeString())
        {
            $rules = [
                'project_title' => 'required',
                'project_desc' => 'required',
                'head_id' => 'required',
                'client_name' => 'required',
                'project_start' => 'required',
                'project_deadline' => 'required|after_or_equal:project_start',
                'member_id' => 'required',
                'status' => 'required|in:Upcoming'];
        }
        else if($request->project_deadline < Carbon::now()->toDateTimeString() && $request->project_start < Carbon::now()->toDateTimeString())
        {
            $rules = [
                'project_title' => 'required',
                'project_desc' => 'required',
                'head_id' => 'required',
                'client_name' => 'required',
                'project_start' => 'required',
                'project_deadline' => 'required|after_or_equal:project_start',
                'member_id' => 'required',
                'status' => 'required|in:Pending,Completed'];
        }
        else
        {
            $rules = [
                'project_title' => 'required',
                'project_desc' => 'required',
                'head_id' => 'required',
                'client_name' => 'required',
                'project_start' => 'required',
                'project_deadline' => 'required|after_or_equal:project_start',
                'member_id' => 'required',
                'status' => 'required|in:Active,Completed'];
        }
    
        $customMessages = [
            'project_title.required' => '*Please enter the project name',
            'project_desc.required' => '*What is the project about ?',
            'head_id.required'  => '*Kindly choose a project head',
            'client_name.required' => '*Please enter the client name',
            'project_start.required' => '*Kindly choose a commencement day for the project',
            'project_deadline.required' => '*Kindly set a deadline for the project',
            'project_deadline.after_or_equal'  => '*Please make sure that a proper deadline is set',
            'status.required' => '*What is the current status of the project ?',
            'member_id.required' => '*Please assign members to the project',            
        ];

        $this->validate($request, $rules, $customMessages);
        
        $project->project_title = $request->project_title;
        $project->project_desc = $request->project_desc;
        $project->head_id = $request->head_id;
        $project->client_name = $request->client_name;       
        $project->project_start = $request->project_start;
        $project->project_deadline = $request->project_deadline;
        $project->status = $request->status;        
        $project->save(); 
        Session::flash('success','Project details added successfully');       
        $project->member()->sync($request->member_id);                 
        return redirect()->route('admin.projects.index');
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
    public function edit(Project $project)
    {
        $arr['project'] = $project;
        $arr['users'] = User::all(); 
        $arr['members'] = Member::all();               
        return view('admin.projects.edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Project $project)
    {
        if($request->project_start > Carbon::now()->toDateTimeString())
        {
            $rules = [
                'project_title' => 'required',
                'project_desc' => 'required',
                'head_id' => 'required',
                'client_name' => 'required',
                'project_start' => 'required',
                'project_deadline' => 'required|after_or_equal:project_start',
                'member_id' => 'required',
                'status' => 'required|in:Upcoming'];
        }
        else if($request->project_deadline < Carbon::now()->toDateTimeString() && $request->project_start < Carbon::now()->toDateTimeString())
        {
            $rules = [
                'project_title' => 'required',
                'project_desc' => 'required',
                'head_id' => 'required',
                'client_name' => 'required',
                'project_start' => 'required',
                'project_deadline' => 'required|after_or_equal:project_start',
                'member_id' => 'required',
                'status' => 'required|in:Pending,Completed'];
        }
        else
        {
            $rules = [
                'project_title' => 'required',
                'project_desc' => 'required',
                'head_id' => 'required',
                'client_name' => 'required',
                'project_start' => 'required',
                'project_deadline' => 'required|after_or_equal:project_start',
                'member_id' => 'required',
                'status' => 'required|in:Active,Completed'];
        }
    
        $customMessages = [
            'project_title.required' => 'Please enter the project name',
            'project_desc.required' => 'What is the project about ?',
            'head_id.required'  => 'Kindly choose a project head',
            'client_name.required' => 'Please enter the client name',
            'project_start.required' => 'Kindly choose a commencement day for the project',
            'project_deadline.required' => 'Kindly set a deadline for the project',
            'project_deadline.after_or_equal'  => 'Please make sure that a proper deadline is set',
            'status.required' => 'What is the current status of the project ?',
            'member_id.required' => 'Please assign members to the project',            
        ];

        $this->validate($request, $rules, $customMessages);
         
        $project->project_title = $request->project_title;
        $project->project_desc = $request->project_desc;
        $project->head_id = $request->head_id;
        $project->client_name = $request->client_name;       
        $project->project_start = $request->project_start;
        $project->project_deadline = $request->project_deadline;
        $project->status = $request->status;
        $project->save();
        Session::flash('success','Project details updated successfully');
        $project->member()->sync($request->member_id);
        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        Project::destroy($id);
        foreach (Member::all() as $member)
        {
            $member->project()->detach($id);
        }
        Session::flash('success','Project details deleted successfully');
        return redirect()->route('admin.projects.index');
    }       
}
