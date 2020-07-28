@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><b>Edit Members</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Members</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{ route('admin.members.update',$member->id) }}">
            @method('PUT')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">            
            <div class="form-group">
                <div class="row">
                    <label class="col-md-3">Name</label> 
                    <div class="col-md-6"><input type="text" name="name" class="form-control" value="{{ $member->name }}"></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div> 
            @error('name')
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
                    <label class="col-md-3">Email</label> 
                    <div class="col-md-6"><input type="email" name="email" class="form-control" value="{{ $member->email }}"></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div>
            @error('email')
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
                    <label class="col-md-3">Date of Joining</label> 
                    <div class="col-md-6"><input type="date" name="doj" class="form-control" value="{{ $member->doj }}"></div>    
                    <div class="clearfix"></div> 
                </div>  
            </div>
            @error('doj')
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