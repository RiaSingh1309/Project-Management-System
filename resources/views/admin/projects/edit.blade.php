@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><b>Edit Projects</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Projects</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('admin.projects.update',$project->id) }}">
            @method('PUT')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">            
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Title</label> 
                    <div class="col-md-6"><input type="text" name="project_title" class="form-control" value="{{ $project->project_title }}"></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div> 
            @error('project_title')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Description</label> 
                    <div class="col-md-6"><textarea name="project_desc" class="form-control">{{ $project->project_desc }}</textarea></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div>
            @error('project_desc')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Head</label> 
                    <div class="col-md-6">
                        <select name="head_id" class="form-control">
                            <option value="">Choose Head</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}"
                                
                                    @if($u->id == $project->head_id)
                                    selected
                                    @endif
                                
                                >{{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="clearfix"></div> 
                </div>  
            </div>
            @error('head_id')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Members</label> 
                    <div class="col-md-6">
                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Choose members</button>
                        <ul class="dropdown-menu">
                            @foreach($members as $m)
                            <li>
                                <div class="container-fluid">                                    
                                    <input type="checkbox" name="member_id[]" value="{{ $m->id }}"
                                    
                                    @if($project->hasUser($m->id))
                                    checked
                                    @endif
                                    
                                    > {{ $m->name }} </input>                                
                                </div>                                
                            </li> 
                            @endforeach                           
                        </ul>                                               
                    </div>                        
                    <div class="clearfix"></div> 
                </div>  
            </div> 
            @error('member_id')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Client</label> 
                    <div class="col-md-6"><input type="text" name="client_name" class="form-control" value="{{ $project->client_name }}"></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div> 
            @error('client_name')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror           
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Start Date</label> 
                    <div class="col-md-6"><input type="date" name="project_start" class="form-control" value="{{ $project->project_start }}"></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div> 
            @error('project_start')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Deadline</label> 
                    <div class="col-md-6"><input type="date" name="project_deadline" class="form-control" value="{{ $project->project_deadline }}"></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div> 
            @error('project_deadline')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Status</label> 
                    <div class="col-md-6">
                        <select name="status" class="form-control">
                            <option value="">Choose Status</option>                           
                                <option value="Completed" @if ($project->status=='Completed') selected @endif>Completed</option>
                                <option value="Pending" @if ($project->status=='Pending') selected @endif>Pending</option>
                                <option value="Active" @if ($project->status=='Active') selected @endif>Active</option>
                                <option value="Upcoming" @if ($project->status=='Upcoming') selected @endif>Upcoming</option>
                        </select>                        
                    </div>    
                    <div class="clearfix"></div> 
                </div>  
            </div>  
            @error('status')
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3"></label> 
                    <div class="col-md-6 text-danger">{{ $message }}</div><br>    
                    <div class="clearfix"></div> 
                </div> 
            </div>               
            @enderror           
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Save">                  
            </div>         
    </div>
</section>
@endsection