@extends('layouts.admin')
@section('content')



<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><b>Members</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{ route('admin.home') }} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Members</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <p>
            <a href="{{ route('admin.members.create') }}" class="btn btn-primary">+ Add New Member</a>
        </p>
        <table class ="table table-bordered table-striped">
            <tr>
                <th><u><h5><b>Action</b></h5></u></th>
                <th><u><h5><b>@sortablelink('id','ID')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('name','Name')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('email','Email')</b></h5></u></th>
                <th><u><h5><b>Projects Assigned</b></h5></u></th> 
                <th><u><h5><b>@sortablelink('doj','Date of Joining')</b></h5></u></th>               
            </tr>
            @if(count($members))
            @foreach($members as $m)
            <tr>
                <td>
                    <a href="{{ route('admin.members.edit',$m->id) }}" class="btn btn-info">Edit</a> 
                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">- Delete</a>
                    <form action="{{ route('admin.members.destroy',$m->id) }}" method="post">
                        @method('DELETE')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </td>
                <td><b>{{ $m->id }}</b></td>
                <td><b>{{ $m->name }}</b></td>
                <td>{{ $m->email }}</td>
                <td><ul>
                @foreach($m->project as $mp)               
                    <a href="{{ route('admin.projects.index') }}" class="text-dark"><li>{{ $mp->project_title }}</li></a>
                @endforeach
                </ul></td> 
                <td>{{ $m->doj }}</td>               
            </tr>
            @endforeach
            @else
            <tr><td colspan="6">No Members Found</td></tr>
            @endif
        </table> 
        {!! $members->appends(\Request::except('page'))->render() !!}               
    </div>
</section>


@endsection