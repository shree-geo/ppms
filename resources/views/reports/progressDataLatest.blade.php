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
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
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

                                <?php $user_group = auth()->user()->user_group_id; ?>
                                @if ($user_group != 2)
                                    <div class="card-title row">
                                        {!! Form::open(['method' => 'get', 'url' => '/reports/s-curve', 'autocomplete' => 'off', 'role' => 'form']) !!}
                                        <div class="form-group  pull-left">
                                            {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2','id' => 'project_id','placeholder' => 'Select Project Name']) }}

                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right"
                                            style="margin-left: 5px; height:42px;">Search</button>

                                        {!! Form::close() !!}
                                    </div>
                                @else
                                    <h3 class="card-title">S-curve</h3>
                                @endif
                                <a href="#" class="pull-right" data-toggle="tooltip" title="Go Back"><i
                                        class="fa fa-arrow-circle-left fa-2x"></i></a>
                            </div>
                            @if ($status)
                                @if (count($allprogressData) > 0)
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
                                        <div class="col-md-12" style="overflow-x:auto;">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    @php
                                                        $target_cum = 0.0;
                                                        $progress_cum = 0.0;
                                                        $new_target = 0.0;
                                                    @endphp
                                                    <tr>
                                                        <th>Year</th>
                                                        @foreach ($allprogressData as $year => $data)
                                                            <?php $datacount = count($data); ?>
                                                            <th colspan={{ $datacount }} class="text-center">
                                                                {{ $year }}</th>
                                                        @endforeach
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        @foreach ($allprogressData as $year => $data5)
                                                            @foreach ($data5 as $val)
                                                                <th>{{ $val->month }}</th>

                                                            @endforeach
                                                        @endforeach
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    @foreach ($scurveData as $revision_id => $scurve)

                                                        <tr>

                                                            <td>{{ $revisions[$revision_id] }} Target</td>
                                                            @foreach ($scurve as $data1)
                                                                @php
                                                                    $new_target = $new_target + ($data1->target != null ? (float) $data1->target : 0);
                                                                @endphp
                                                                <td>{{ $new_target }}</td>

                                                            @endforeach
                                                        </tr>
                                                        @php
                                                            $new_target = 0.0;
                                                        @endphp
                                                    @endforeach

                                                    <tr>

                                                        @foreach ($progressData as $rev_id => $value)
                                                        
                                                            @if ($loop->first) <td>{{ $value->rid == null ? 'Initial Target' : $revisions[$value->rid + 1] }}</td>@endif
                                                            @if($value->target!=null)
                                                            @php
                                                                $target_cum = $target_cum + (float) $value->target ;
                                                            @endphp
                                                            <td>{{ $target_cum }}</td>
                                                            @else
                                                            <td>0.00</td>
                                                            @endif
                                                        @endforeach

                                                    </tr>

                                                    <tr>
                                                        <td>Actual progress</td>
                                                        @foreach ($progressData as $rev_id => $value)
                                                            @if($value->progress!=null)
                                                            @php
                                                                $progress_cum = $progress_cum + (float) $value->progress ;
                                                            @endphp
                                                            <td>{{ $progress_cum }}</td>
                                                            @else
                                                            <td>0.00</td>
                                                            @endif

                                                        @endforeach
                                                    </tr>
                                                 
                                                    <tr>
                                                        <td>Financial progress</td>
                                                        @foreach ($progressData as $rev_id => $value)
                                                            <td>{{ $value->financial_progress ? $value->financial_progress : 0.0 }}
                                                            </td>

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

    <script src="{{ url('lib\HighCharts\code\highcharts.js') }}"></script>
    <script src="{{ url('lib\HighCharts\code\modules/series-label.js') }}"></script>
    <script src="{{ url('lib\HighCharts\code\modules/exporting.js') }}"></script>
    <script src="{{ url('lib\HighCharts\code\modules/export-data.js') }}"></script>
    <script src="{{ url('lib\HighCharts\code\modules/accessibility.js') }}"></script>

    <script>
        var progress = {!! json_encode($progressData) !!};
        var revisions = {!! json_encode($revisions) !!};
        var revisionData = {!! json_encode($scurveData) !!};
        var targetArr = [];
        var target_total = 0.0;
        var target_cum = [];
        var progress_total = 0.0;
        var progress_cum = [];
        var progressArr = [];
        var financialArr = [];
        var monthArr = [];

        for (var key in progress) {


            progress_total = (parseFloat(progress_total) + parseFloat(progress[key].progress)).toFixed(3);
            target_total = (parseFloat(target_total) + parseFloat(progress[key].target)).toFixed(3);

            targetArr.push(isNaN(progress[key].target) ? 0 : parseFloat(progress[key].target));
            progressArr.push(parseFloat(progress[key].progress));

            progress_cum.push(parseFloat(progress_total));
            target_cum.push(parseFloat(target_total));


            financialArr.push(parseFloat(progress[key].financial_progress));
            monthArr.push(progress[key].month);

        }

        var revisionArr = [];
        var rev_target_total = 0.0;
        var rev_target_cum = [];
        for (var key2 in revisionData) {
            revisionArr[revisions[key2]] = [];
            rev_target_cum[revisions[key2]] = [];
            for (var key1 in revisionData[key2]) {
                rev_target_total = (parseFloat(rev_target_total) + parseFloat(revisionData[key2][key1].target)).toFixed(3);

                revisionArr[revisions[key2]].push(isNaN(revisionData[key2][key1].target) ? 0 : parseFloat(revisionData[key2]
                    [key1].target));

                rev_target_cum[revisions[key2]].push(parseFloat(rev_target_total));
            }
        }


        datachart = [];

        for (key in rev_target_cum) {
            datachart.push({
                name: key + 'Target',
                data: rev_target_cum[key]
            });

        }

        datachart.push({
            name: progress[0].rid == null ? 'initital Target' : revisions[progress[0].rid + 1],
            data: target_cum
        });
    


        datachart.push({
            name: 'Progress',
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
            series: datachart,

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
