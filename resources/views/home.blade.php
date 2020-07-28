@extends('layouts.admin')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<?php    
    $totalp = count($projects);
    $totalpp = 0;
    $totalpa = 0;
    $totalpc = 0;
    $totalpu = 0;
    foreach($projects as $p)
    {
        if($p->status == 'Pending')
        {
            $totalpp = $totalpp + 1;
        } 
        else if($p->status == 'Active')
        {
            $totalpa = $totalpa + 1;
        }
        else if($p->status == 'Completed')
        {
            $totalpc = $totalpc + 1;
        }
        else
        {
            $totalpu = $totalpu + 1;
        }       
    }
    $totalppp = $totalpp/$totalp*100;
    $totalpap = $totalpa/$totalp*100;
    $totalpcp = $totalpc/$totalp*100;
    $totalpup = $totalpu/$totalp*100;
?>
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0 text-dark">Project Management System</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
                <div class="info-box-content">
                <span class="info-box-text"><b><u>Pending</u></b></span>
                <span class="info-box-number"><?php echo $totalpp ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-calendar-check"></i></span>
                <div class="info-box-content">
                <span class="info-box-text"><b><u>Active</u></b></span>
                <span class="info-box-number"><?php echo $totalpa ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                <span class="info-box-text"><b><u>Completed</u></b></span>
                <span class="info-box-number"><?php echo $totalpc ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-angle-double-right"></i></span>
                <div class="info-box-content">
                <span class="info-box-text"><b><u>Upcoming</u></b></span>
                <span class="info-box-number"><?php echo $totalpu ?></span>
                </div>
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
            
                <div class="row">
                    <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title"><b>Members</b></h3>

                        <div class="card-tools">                            
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($members as $m)
                            <li>
                            <img src="{{ asset('dist/img/member-128x128.jpg') }}" alt="User Image">
                            <a class="users-list-name" href="{{ route('admin.members.index') }}">{{ $m->name }}</a>
                            <span class="users-list-date">{{ $m->doj }}</span>
                            </li>
                            @endforeach                            
                        </ul>
                        <!-- /.users-list -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                        <a href="{{ route('admin.members.index') }}">View All Members</a>
                        </div>
                    </div>            
                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">
                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">
                        <h3 class="card-title"><b>Heads</b></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($users as $u)
                            <li>
                            <img src="{{ asset('dist/img/head-128x128.jpg') }}" alt="User Image">
                            <a class="users-list-name" href="{{ route('admin.users.index') }}">{{ $u->name }}</a>                            
                            </li>
                            @endforeach                            
                        </ul>
                        <!-- /.users-list -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                        <a href="{{ route('admin.users.index') }}">View All Heads</a>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- TABLE: LATEST ORDERS -->
                <div class="card">
                    <div class="card-header border-transparent">
                    <h3 class="card-title"><b>Projects</b></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                        <thead>
                        <tr>
                            <th><u><b>ID</b></u></th>
                            <th><u><b>Title</b></u></th>                            
                            <th><u><b>Head</b></u></th>
                            <th><u><b>Client</b></u></th>                
                            <th><u><b>Members</b></u></th>                            
                            <th><u><b>Status</b></u></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($projects as $p)
                            <tr>
                                <td><b>{{ $p->id }}</b></td>
                                <td><b>{{ $p->project_title }}</b></td>
                                <td>@if($p->user)<a href="{{ route('admin.users.index') }}" class="text-dark">{{ $p->user->name }}</a>@endif</td>
                                <td>{{ $p->client_name }}</td>
                                <td><ul>
                                @foreach($p->member as $pm)               
                                    <a href="{{ route('admin.members.index') }}" class="text-dark"><li>{{ $pm->name }}</li></a>
                                @endforeach
                                </ul></td>
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
                        </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-info float-left">New Project</a>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-secondary float-right">Update Project</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title"><b>Project Statistics</b></h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <div class="row">
                        <canvas id="doughnut-chart" height="150"></canvas>
                    </div>
                    <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-white p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                        <a href="#" class="nav-link">
                            Pending
                            <span class="float-right text-danger">
                            <i class="fas fa-arrow-down text-sm"></i><?php echo $totalppp ?>%
                            </span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">
                            Completed
                            <span class="float-right text-success">
                            <i class="fas fa-arrow-up text-sm"></i><?php echo $totalpcp ?>%
                            </span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">
                            Active
                            <span class="float-right text-warning">
                            <i class="fas fa-arrow-left text-sm"></i><?php echo $totalpap ?>%
                            </span>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a href="#" class="nav-link">
                            Upcoming
                            <span class="float-right text-primary">
                            <i class="fas fa-arrow-right text-sm"></i><?php echo $totalpup ?>%
                            </span>
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
        </div><!--/. container-fluid -->
    </section>
    <script>
        new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
        display: false,
        labels: ["Pending", "Completed", "Active", "Upcoming"],
        datasets: [
            {            
            backgroundColor: ["red", "green","yellow","blue"],
            data: [<?php echo $totalppp ?>,<?php echo $totalpcp ?>,<?php echo $totalpap ?>,<?php echo $totalpup ?>]
            }
        ]
        }
    });
    </script>
<!-- /.content -->
@endsection
