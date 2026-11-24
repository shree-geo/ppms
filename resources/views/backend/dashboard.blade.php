@extends('backend.layouts.app')
@section('title')
  Dashboard
@endsection

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
            <!-- Info boxes -->
          <div class="col-md-12">
               <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">WUSC Member Status</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-header">
                              <div class="pull-right">
                            <button class="btn bg-primary btn-flat"></button> Comply &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn bg-danger btn-flat"></button> WUSC doesnot contain 9 members &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn bg-purple btn-flat"></button> WUSC doesnot contain 3 female members &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn bg-warning btn-flat"></button> WUSC doesnot contain 1 female at key position &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th style="width: 50%;">Project</th>
                                    <th style="width: 50%;">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $i=1; ?>
                                    @foreach($projects as $key=>$project)
                                @if(isset($memberStatus[$key]))
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td style="width: 50%;">{{$project}}</td>
                                        @foreach($colors as $key1=>$color)
                                        @if($key1==$memberStatus[$key])
                                       <td> <button class="btn bg-{{$color}} btn-flat"></button></td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    @endif
                                    
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

           </div>
           <div class="col-md-12">
               <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Project Status</h3>
                            <h3 class="card-title ml-4">Year:<b> {{$year}}</b></h3>
                            <h3 class="card-title ml-4">Month:<b> {{$month_name}}</b></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                           
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th style="width: 50%;">Project</th>
                                    <th >Target</th>
                                    <th >Progress</th>
                                    <th >Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                   
                                    @foreach($projects as $key=>$project)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td style="width: 50%;">{{$project}}</td>
                                       @if(count($progressData)>0)
                                        <td>{{isset($progressData[$key])?$progressData[$key][0]['target']:''}}</td>
                                        <td>{{isset($progressData[$key])?$progressData[$key][0]['progress']:''}}</td>
                                        <td>
                                            <span class="{{isset($progressData[$key]) && $progressData[$key][0]['status']=='Behind Target'?'badge badge-danger':'badge badge-success'}}">{{isset($progressData[$key])?$progressData[$key][0]['status']:''}}</span>
                                        </td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @endif
                                    </tr>
                                    
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

           </div>  
             <div class="col-md-12">
               <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Project Status</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                           
                        </div>
                        <div class="card-body">
                            <div class="col-md-12"  >
                                <div class="pt-4">
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                        <p class="highcharts-description">
                                   
                                        </p>
                                    </figure>
                                </div>
                                </div>
                                
                                
                            </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                          
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th style="width: 50%;">Project</th>
                                    <th >Target</th>
                                    <th >Progress</th>
                                    <th >Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                   
                                    @foreach($projects as $key=>$project)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td style="width: 50%;">{{$project}}</td>
                                       @if(count($cumulativeProgress)>0)
                                        <td>{{isset($cumulativeProgress[$key])?$cumulativeProgress[$key][0]['target_total']:0}} %</td>
                                        <td>{{isset($cumulativeProgress[$key])?$cumulativeProgress[$key][0]['progress_total']:0}} %</td>
                                        <td>
                                            <span class="{{isset($cumulativeProgress[$key]) && $cumulativeProgress[$key][0]['status']=='Behind Target'?'badge badge-danger':'badge badge-success'}}">{{isset($cumulativeProgress[$key])?$cumulativeProgress[$key][0]['status']:''}}</span>
                                        </td>
                                      
                                        @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @endif
                                    </tr>
                                    
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

           </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
<script src="{{url('lib\HighCharts\code\highcharts.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/exporting.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/export-data.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/accessibility.js')}}"></script>
<script>
    var projects={!! json_encode($projects) !!};

    var progress={!! json_encode($cumulativeProgress) !!};
    var project_name=[];
    var target=[];
    var progress_total=[];
    for(var key in projects ){
        if(typeof(progress[key])!='undefined'){
         project_name.push(projects[key]);
            target.push(parseInt(progress[key][0].target_total));
            progress_total.push(parseInt(progress[key][0].progress_total));

        }
   
    
}

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Physical Progress'
    },
    xAxis: {
        categories: project_name,
        crosshair: true
    },
    yAxis: {
        min: 0,
       
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    
    series: [{
        name: 'Target',
        data: target

    }, {
        name: 'Progress',
        data: progress_total

    }]
});

</script>
@endsection