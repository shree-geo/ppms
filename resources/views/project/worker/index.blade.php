@extends('backend.layouts.app')
@section('title')
    Project Worker
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Worker Details </h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Worker</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="col-md-12" id="listing">
                        <div class="card card-default">
                            <div class="card-header with-border">
                                <h3 class="card-title">Workers Details</h3>

                                <?php
                                
                                $permission = helperPermissionLink(url('project/worker/create'), url('project/worker'));
                                
                                $allowEdit = $permission['isEdit'];
                                
                                $allowDelete = $permission['isDelete'];
                                
                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                                {!! Form::open(['method' => 'get', 'url' => '/project/worker', 'autocomplete' => 'off', 'role' => 'form']) !!}
                                <div class="form-group  pull-left col-md-3">
                                    {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}

                                </div>
                                <button type="submit" class="btn btn-primary pull-right"
                                    style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i>
                                    Search</button>

                                {!! Form::close() !!}
                                <button class="btn btn-success pull-right" onclick="exportData()" style=" height:42px;"><i
                                        class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                            </div>
                            <div class="card-body">
                                @if (!count($workers) <= 0)
                                    <div class="col-md-12 " style="overflow-x:auto;">
                                        <table 
                                            class="table table-striped table-bordered table-hover ">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">{{ trans('app.sn') }}</th>
                                                    @if (auth()->user()->user_group_id != 2)
                                                        <th>Subproject Name</th>
                                                    @endif
                                                    <th>Year </th>
                                                    <th>Month </th>
                                                    <th>Status</th>
                                                    <th colspan="3" style="font-weight: bold;">Skilled</th>
                                                    <th colspan="3" style="font-weight: bold;">Unskilled</th>
                                                    <th colspan="18" style="font-weight: bold;">Laborers/Workers by Sex and
                                                        Ethnicity</th>
                                                     <th colspan="3"></th>
                                                    <th colspan="3" style="width: 60px; !important" class="text-right">Action</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    @if (auth()->user()->user_group_id != 2)
                                                        <th></th>
                                                    @endif
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th colspan="3" style="font-weight: bold;"> </th>
                                                    <th colspan="3" style="font-weight: bold;"> </th>

                                                    <th colspan="3" style="font-weight: bold;">Braman/Chhetri</th>
                                                    <th colspan="3" style="font-weight: bold;">Janajati</th>
                                                    <th colspan="3" style="font-weight: bold;">Dalit</th>
                                                    <th colspan="3" style="font-weight: bold;">Muslim</th>
                                                    <th colspan="3" style="font-weight: bold;">Others</th>
                                                    <th colspan="3" style="font-weight: bold;">Local</th>
                                                    <th colspan="3" style="font-weight: bold;">Total</th>
                                                    <th></th>

                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    @if (auth()->user()->user_group_id != 2)
                                                        <th></th>
                                                    @endif
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    @for ($i = 1; $i <= 9; $i++)
                                                        <th style="font-weight: bold;">M</th>
                                                        <th style="font-weight: bold;">F</th>
                                                        <th style="font-weight: bold;">T</th>
                                                    @endfor


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $col_dalit_m = 0;
                                                $col_dalit_f = 0;
                                                $col_dalit_t = 0;
                                                $col_janjati_m = 0;
                                                $col_janjati_f = 0;
                                                $col_janjati_t = 0;
                                                $col_bramin_m = 0;
                                                $col_bramin_f = 0;
                                                $col_bramin_t = 0;
                                                $col_muslim_m = 0;
                                                $col_muslim_f = 0;
                                                $col_muslim_t = 0;
                                                $col_others_m = 0;
                                                $col_others_f = 0;
                                                $col_others_t = 0; 
                                                 $col_local_m = 0;
                                                $col_local_f = 0;
                                                $col_local_t = 0;
                                                $col_skill_m = 0;
                                                $col_skill_f = 0;
                                                $col_skill_t = 0;
                                                $col_unskill_m = 0;
                                                $col_unskill_f = 0;
                                                $col_unskill_t = 0;
                                                $total_female_r = 0;
                                                $total_male_r = 0;
                                                $total_t_r = 0;
                                                ?>
                                                @foreach ($workers as $key => $worker)
                                                    @foreach ($worker as $val)

                                                        <tr>
                                                            <th scope=row>{{ $i }}</th>
                                                            @if (auth()->user()->user_group_id != 2)
                                                                <td>{{ $val->project->name }}</td>
                                                            @endif
                                                            <td>{{ $val->year }}</td>
                                                            <td>{{ $monthList[$val->month] }}</td>

                                                            <td><span id="dynamicStatus_{{ $val->id }}"
                                                                    class="color-{{ $val->status == 'submitted' ? 'grey' : ($val->status == 'approved' ? 'green' : ($val->status == 'canceled' ? 'red' : 'peru')) }}">{{ ucfirst($val->status) }}</span>
                                                            </td>
                                                            <?php $skill_t = $val->skill_male + $val->skill_female; ?>
                                                            <td>{{ $val->skill_male }}</td>
                                                            <td>{{ $val->skill_female }}</td>
                                                            <td style="font-weight: bold">{{ $skill_t }}</td>

                                                            <?php $unskill_t = $val->unskill_male + $val->unskill_female; ?>
                                                            <td>{{ $val->unskill_male }}</td>
                                                            <td>{{ $val->unskill_female }}</td>
                                                            <td style="font-weight: bold">{{ $unskill_t }}</td>

                                                            <?php $bramin_t = $val->bramin_m + $val->bramin_f; ?>
                                                            <td>{{ $val->bramin_m }}</td>
                                                            <td>{{ $val->bramin_f }}</td>
                                                            <td style="font-weight: bold">{{ $bramin_t }}</td>

                                                            <?php $janjati_t = $val->janjati_m + $val->janjati_f; ?>
                                                            <td>{{ $val->janjati_m }}</td>
                                                            <td>{{ $val->janjati_f }}</td>
                                                            <td style="font-weight: bold">{{ $janjati_t }}</td>

                                                            <?php $dalit_t = $val->dalit_m + $val->dalit_f; ?>
                                                            <td>{{ $val->dalit_m }}</td>
                                                            <td>{{ $val->dalit_f }}</td>
                                                            <td style="font-weight: bold">{{ $dalit_t }}</td>

                                                            <?php $muslim_t = $val->muslim_m + $val->muslim_f; ?>
                                                            <td>{{ $val->muslim_m }}</td>
                                                            <td>{{ $val->muslim_f }}</td>
                                                            <td style="font-weight: bold">{{ $muslim_t }}</td>

                                                         

                                                            <?php $others_t = $val->others_m + $val->others_f; ?>
                                                            <td>{{ $val->others_m }}</td>
                                                            <td>{{ $val->others_f }}</td>
                                                            <td style="font-weight: bold">{{ $others_t }}</td>
                                                            
                                                            <?php $local_t = $val->local_m + $val->local_f; ?>
                                                            <td>{{ $val->local_m }}</td>
                                                            <td>{{ $val->local_f }}</td>
                                                            <td style="font-weight: bold">{{ $local_t }}</td>
                                                            <?php
                                                            $total_m = $val->bramin_m + $val->janjati_m + $val->dalit_m + $val->muslim_m + $val->others_m;
                                                            $total_f = $val->bramin_f + $val->janjati_f + $val->dalit_f + $val->muslim_f + $val->others_f;
                                                            $total_t = $bramin_t + $janjati_t + $dalit_t + $muslim_t + $others_t;
                                                            $total_female_r += $total_f;
                                                            $total_male_r += $total_m;
                                                            $total_t_r += $total_t;
                                                            ?>

                                                            <td>{{ $total_m }}</td>
                                                            <td>{{ $total_f }}</td>
                                                            <td style="font-weight: bold">{{ $total_t }}</td>

                                                            <td class="text-right row" style="margin-right: 0px;" id="action_{{ $val->id }}">
                                                                @if ($val->status != 'approved' || auth()->user()->user_group_id != 2 && auth()->user()->user_group_id != 3)
                                                                    @if ($allowEdit)
                                                                        <a href="{{ route('worker.edit', [$val->id]) }}"
                                                                            class="text-info btn btn-xs btn-default"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Edit">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>&nbsp;
                                                                    @endif

                                                                    @if ($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['worker.destroy', $val->id], 'class' => 'inline']) !!}
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Delete"
                                                                            onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>

                                                                        {!! Form::close() !!}
                                                                    @endif
                                                                    @if (auth()->user()->user_group_id == 3)
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary btn-xs pull-right boxTopButton"
                                                                            data-toggle="modal"
                                                                            data-target="#status_{{ $val->id }}">
                                                                            <i class="fa fa-eye"></i>
                                                                        </button>

                                                                        @include('project.layouts.approveStatusModel')
                                                                    @endif
                                                                @endif



                                                            </td>
                                                            <?php
                                                            $row_t = $dalit_t + $janjati_t + $bramin_t + $muslim_t + $others_t;
                                                            $col_dalit_m += $val->dalit_m;
                                                            $col_dalit_f += $val->dalit_f;
                                                            $col_dalit_t += $dalit_t;
                                                            
                                                            $col_janjati_m += $val->janjati_m;
                                                            $col_janjati_f += $val->janjati_f;
                                                            $col_janjati_t += $janjati_t;
                                                            
                                                            $col_bramin_m += $val->bramin_m;
                                                            $col_bramin_f += $val->bramin_f;
                                                            $col_bramin_t += $bramin_t;
                                                            
                                                            $col_muslim_m += $val->muslim_m;
                                                            $col_muslim_f += $val->muslim_f;
                                                            $col_muslim_t += $muslim_t;
                                                            
                                                            $col_others_m += $val->others_m;
                                                            $col_others_f += $val->others_f;
                                                            $col_others_t += $others_t;  
                                                            
                                                            $col_local_m += $val->local_m;
                                                            $col_local_f += $val->local_f;
                                                            $col_local_t += $local_t;
                                                            
                                                            $col_skill_m += $val->skill_male;
                                                            $col_skill_f += $val->skill_female;
                                                            $col_skill_t += $skill_t;
                                                            $col_unskill_m += $val->unskill_male;
                                                            $col_unskill_f += $val->unskill_female;
                                                            $col_unskill_t += $unskill_t;
                                                            
                                                            ?>
                                                        </tr>
                                                        <?php $i++; ?>

                                                    @endforeach
                                                @endforeach
                                                <tr>
                                                    <th style="font-weight: bold; text-align:center;"
                                                        colspan="{{ auth()->user()->user_group_id != 2 ? 5 : 4 }}">Total</th>
                                                    <td style="font-weight: bold">{{ $col_skill_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_skill_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_skill_t }}</td>

                                                    <td style="font-weight: bold">{{ $col_unskill_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_unskill_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_unskill_t }}</td>

                                                    <td style="font-weight: bold">{{ $col_bramin_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_bramin_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_bramin_t }}</td>


                                                    <td style="font-weight: bold">{{ $col_janjati_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_janjati_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_janjati_t }}</td>

                                                    <td style="font-weight: bold">{{ $col_dalit_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_dalit_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_dalit_t }}</td>

                                                    <td style="font-weight: bold">{{ $col_muslim_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_muslim_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_muslim_t }}</td>

                                                    <td style="font-weight: bold">{{ $col_others_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_others_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_others_t }}</td> 
                                                    
                                                    <td style="font-weight: bold">{{ $col_local_m }}</td>
                                                    <td style="font-weight: bold">{{ $col_local_f }}</td>
                                                    <td style="font-weight: bold">{{ $col_local_t }}</td>

                                                    <td style="font-weight: bold">{{ $total_male_r }}</td>
                                                    <td style="font-weight: bold">{{ $total_female_r }}</td>
                                                    <td style="font-weight: bold">{{ $total_t_r }}</td>


                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                @else
                                    <div class="col-md-12">
                                        <label class="form-control label-danger">No records found</label>
                                    </div>
                                @endif

                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>


                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection
@section('js')
    <script>
        function sendRequest(id) {
            var status_id = 'statusdetail_' + id;
            var comment_id = 'comments_' + id;
            var status = document.getElementById(status_id).value;
            var comment = document.getElementById(comment_id).value;
            $('.modal').modal('hide');


            $.ajax({
                type: 'post',
                url: baseurl + '/project/worker/workerStatus',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'worker_details_id': id,
                    'status': status,
                    'comment': comment,
                },
                success: function(data) {
                    var color = status == 'approved' ? 'green' : status == 'canceled' ? 'red' : 'peru';
                    document.getElementById(comment_id).value = '';
                    $('#dynamicStatus_' + id).html('');
                    $('#dynamicStatus_' + id).html(status.charAt(0).toUpperCase() + status.slice(1));
                    $('#dynamicStatus_' + id).removeClass().addClass('color-' + color);
                    if(status=='approved'){
                        $('#action_'+id).hide();
                    }
                },
                error: function(err) {

                },
            })
        }
    </script>


    <script>
        function exportData() {
            var project_id = $('#project_id').val();
            // var url = baseurl + '/exports/workerDetailExport' + '?project_id=' + project_id;
            var url = baseurl + '/project/worker' + '?project_id=' + project_id + '&export=export';
            window.location = url;
        }
    </script>
@endsection
