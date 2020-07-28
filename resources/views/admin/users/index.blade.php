@extends('layouts.admin')
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><b>Heads</b></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href=" {{ route('admin.home') }} ">Dashboard</a></li>
                    <li class="breadcrumb-item active">Heads</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">       
        <table class ="table table-bordered table-striped">
            <tr>
                <th><u><h5><b>@sortablelink('id','ID')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('name','Name')</b></h5></u></th>
                <th><u><h5><b>@sortablelink('email','Email')</b></h5></u></th>
                <th><u><h5><b>Projects Assigned</b></h5></u></th> 
            </tr>
            @if(count($users))
            @foreach($users as $u)
            <tr>
                <td><b>{{ $u->id }}</b></td>
                <td><b>{{ $u->name }}</b></td>
                <td>{{ $u->email }}</td>
                <td><ul>
                @foreach($projects as $p)
                @if($p->head_id == $u->id)
                <a href="{{ route('admin.projects.index') }}" class="text-dark"><li>
                    {{ $p->project_title }}                
                </li></a>
                @endif
                @endforeach
                </ul></td>              
            </tr>
            @endforeach
            @else
            <tr><td colspan="4">No Heads Found</td></tr>
            @endif
        </table> 
                       
    </div>
</section>
@endsection