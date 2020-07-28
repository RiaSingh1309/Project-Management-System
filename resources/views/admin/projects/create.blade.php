@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><b>Add Projects</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Add Projects</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('admin.projects.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">              
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Title</label> 
                    <div class="col-md-6"><input type="text" name="project_title" class="form-control" value="{{ old('project_title') }}"></div>    
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
                    <div class="col-md-6"><textarea name="project_desc" class="form-control">{{ old('project_desc') }}</textarea></div>    
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
                                <option value="{{ $u->id }}" @if (old('head_id')==$u->id) selected @endif>{{ $u->name }}</option>
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
                    <?php
                        if(old('member_id'))
                        {
                            $member_idArray = old('member_id');
                        }
                        else
                        {
                            $member_idArray = [];
                        }
                    ?>
                    <div class="col-md-6">
                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle">Choose members</button>
                        <ul class="dropdown-menu">
                            @foreach($members as $m)
                            <li>
                                <div class="container-fluid">                                    
                                    <input type="checkbox" name="member_id[]" value="{{ $m->id }}" @if(in_array($m->id,$member_idArray)) checked @endif> {{ $m->name }} </input>                                
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
                    <div class="col-md-6"><input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}"></div>    
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
                    <div class="col-md-6"><input type="date" name="project_start" class="form-control" value="{{ old('project_start') }}"></div>    
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
                    <div class="col-md-6"><input type="date" name="project_deadline" class="form-control" value="{{ old('project_deadline') }}"></div>    
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
                            <option value="Completed" @if (old('status')=='Completed') selected @endif>Completed</option>
                            <option value="Pending" @if (old('status')=='Pending') selected @endif>Pending</option>
                            <option value="Active" @if (old('status')=='Active') selected @endif>Active</option>
                            <option value="Upcoming" @if (old('status')=='Upcoming') selected @endif>Upcoming</option>
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