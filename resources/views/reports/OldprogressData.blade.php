@extends('backend.layouts.app')
@section('title')
   S-curve
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>S-curve</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Reports</li>
                            <li class="breadcrumb-item active">S-curve</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="col-md-12" id="listing">
                        <div class="card card-default">
                            <div class="card-header with-border">
                               
                            <?php $user_group=auth()->user()->user_group_id; ?>
                            @if($user_group!=2)
                            <div class="card-title row" >
                             {!! Form::open(['method'=>'get','url'=>'/reports/s-curve', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group  pull-left">
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;">Search</button>

                                {!! Form::close() !!}
                        </div>
                        @else
                         <h3 class="card-title">S-curve</h3>
                        @endif
                        <a href="#" class="pull-right" data-toggle="tooltip" title="Go Back"><i
                            class="fa fa-arrow-circle-left fa-2x"></i></a>
                        </div>
                        @if ($status)
                            @if(count($allprogressData)>0)
                            <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="col-md-12 topFilter">
                                          <figure class="highcharts-figure">
                                            <div id="container"></div>
                                            
                                            </figure>
                                        </div>

                                    </div> 

                            </div>
                            <div class="card-body">
                                        <div class="col-md-12"  style="overflow-x:auto;">
                                         <table class="table table-striped table-bordered table-hover">
                                             <thead>
                                            <tr>
                                                 <th>Year</th>
                                                 @foreach($allprogressData as $year=>$data)
                                                 <?php $datacount= count($data); ?>
                                                 <th colspan={{$datacount}} class="text-center">{{$year}}</th>
                                                 @endforeach
                                                 </tr>
                                                 <tr>
                                                     <th></th>
                                                     @foreach($allprogressData as $year=>$data)
                                                     @foreach($data as $val)
                                                     <th>{{$val->month}}</th>

                                                     @endforeach
                                                     @endforeach
                                                 </tr>
                                               
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <th>Initital Target</th>
                                                    @foreach($allprogressData as $year=>$data)
                                                     @foreach($data as $val)
                                                        <td>{{$val->target?$val->target:0}}</td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                    <?php $target_total=0;
                                                            $progress_total=0; ?>
                                                    <tr>
                                                    <th>Initital Target Cum</th>
                                                    @foreach($allprogressData as $year=>$data)
                                                     @foreach($data as $val)
                                                          <?php $target_total+=$val->target; ?>
                                                        <td>{{$target_total}}</td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        @foreach($scurveData as $revision => $data2)
                                                        <th>{{$revision}}</th>
                                                        @foreach($allprogressData as $year => $progressData)
                                                        @foreach($data2[$year] as $val)
                                                    <td>{{$val->progress!=null?$val->progress:0}}</td>
                                                    @endforeach
                                                    @endforeach
                                                        
                                                    @endforeach
                                                </tr>
                                                    <tr>
                                                    <th>Actual Progress</th>
                                                    @foreach($allprogressData as $year=>$data)
                                                     @foreach($data as $val)
                                                        <td>{{$val->progress?$val->progress:0}}</td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                       <tr>
                                                    <th>Progress Cum</th>
                                                    @foreach($allprogressData as $year=>$data)
                                                     @foreach($data as $val)
                                                       <?php $progress_total+=$val->progress; ?>
                                                        <td>{{$progress_total}}</td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                    <th>Financial Progress</th>
                                                    @foreach($allprogressData as $year=>$data)
                                                     @foreach($data as $val)
                                                        <td>{{$val->financial_progress?$val->financial_progress:0}}</td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                </tbody>

                                         </table>
                                        </div>

                                    </div>
                                

                            </div>
                            @else
                            <div class="card-body">
                                <h5 class="text-danger text-center" style="font-weight: bold;">No Data !!</h5>
                            </div>
                            @endif
                            @else
                            <div class="card-body">
                            <div class="callout callout-info">
                                Please select the Sub Project name from above drop down.
                            </div>
                            </div>
                     @endif

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>


            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection
@section('js')

<script src="{{url('lib\HighCharts\code\highcharts.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/series-label.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/exporting.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/export-data.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/accessibility.js')}}"></script>

<script>
var progress={!! json_encode($progressData) !!};
var revisionData={!! json_encode($scurveData) !!};
var targetArr=[];
var target_total=0.0;
var target_cum=[];
var progress_total=0.0;
var progress_cum=[];
var progressArr=[];
var financialArr=[];
var monthArr=[];
// console.log(progress);
for(var key in progress ){
   target_total=(parseFloat(target_total)+parseFloat(progress[key].target)).toFixed(3);
    targetArr.push(parseFloat(progress[key].target));
    target_cum.push(parseFloat(target_total));

    progress_total=(parseFloat(progress_total)+parseFloat(progress[key].progress)).toFixed(3);
    progressArr.push(parseFloat(progress[key].progress));
    progress_cum.push(parseFloat(progress_total));

    financialArr.push(parseFloat(progress[key].financial_progress));
    monthArr.push(progress[key].month);
    
}
console.log(targetArr);
var revisionArr=[];
// for (var key in revisionData) {
// for (var key1 in revisionData[key]) {
//     revisionArr[key1]=[];
// for (var key2 in revisionData[key][key1]) {
// // console.log(revisionData[key][key1][key2]);
//     revisionArr[key1].push((typeof(revisionData[key][key1][key2].progress==='undefined') ||(revisionData[key][key1][key2].progress)=='null')?0:parseFloat(revisionData[key][key1][key2].progress));
    

// }
// }
// }

datachart=[];

datachart.push({ 
        name: 'Initial Target',
        data: targetArr
        });
datachart.push({ 
       name: 'Initial Target Cum',
        data: target_cum
        });

// for( key in revisionArr){
//     datachart.push({                        
//         name: key,
//         data: revisionArr[key]
//     });

// }

datachart.push({ 
       name: 'Progress',
        data: progressArr
        });

datachart.push({ 
        name: 'Progress Cum',
        data: progress_cum
        });

datachart.push({ 
       name: 'Financial Progress',
        data: financialArr
        });


    Highcharts.chart('container', {
        
    chart: {
        type: 'line'
    },
    title: {
        text: 'Project Monitoring S-curve'
    },

    yAxis: {
        title: {
            text: ''
        }
    },

    xAxis: {
            categories: monthArr
      
    },

    legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
    },

  plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    series:datachart,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>

@endsection
