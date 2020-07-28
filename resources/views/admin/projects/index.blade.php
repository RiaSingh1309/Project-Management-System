@extends('layouts.admin')
@section('content')



<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><b>Projects</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{ route('admin.home') }} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <p>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Add New Project</a>
        </p>
        <table class ="table table-bordered table-striped">
            <tr>
                <th><u><h5><b>Action</b></h5></u></th>
                <th><u><h5><b>@sortablelink('id','ID')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('project_title','Title')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('project_desc','Description')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('head_id','Head')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('client_name','Client')</b></h5></u></th>                
                <th><u><h5><b>Members</b></h5></u></th>
                <th><u><h5><b>@sortablelink('project_start','Start Date')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('project_deadline','Deadline')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('status','Status')</b></h5></u></th>
            </tr>
            @if(count($projects))
            @foreach($projects as $p)
            <tr>
                <td>
                    <a href="{{ route('admin.projects.edit',$p->id) }}" class="btn btn-info">Edit</a> 
                    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger">- Delete</a>
                    <form action="{{ route('admin.projects.destroy',$p->id) }}" method="post">
                        @method('DELETE')
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </td>
                <td><b>{{ $p->id }}</b></td>
                <td><b>{{ $p->project_title }}</b></td>
                <td>{{ $p->project_desc }}</td>
                <td> @if($p->user)<a href="{{ route('admin.users.index') }}" class="text-dark">{{ $p->user->name }}</a>@endif </td>
                <td>{{ $p->client_name }}</td>
                <td><ul>
                @foreach($p->member as $pm)               
                    <a href="{{ route('admin.members.index') }}" class="text-dark"><li>{{ $pm->name }}</li></a>
                @endforeach
                </ul></td>                
                <td>{{ $p->project_start }}</td>
                <td>{{ $p->project_deadline }}</td>
                <td>
                    <span class="lead">
                        @if($p->status == 'Completed')
                            <span class="badge badge-success">
                                {{ $p->status }}
                            </span>
                        @elseif($p->status == 'Active')
                            <span class="badge badge-warning">
                                {{ $p->status }}
                            </span>
                        @elseif($p->status == 'Pending')
                            <span class="badge badge-danger">
                                {{ $p->status }}
                            </span>
                        @else
                            <span class="badge badge-info">
                                {{ $p->status }}
                            </span>
                        @endif
                    </span>
                </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="10">No Projects Found</td></tr>
            @endif
        </table>   
        {!! $projects->appends(\Request::except('page'))->render() !!}             
    </div>
</section>



@endsection