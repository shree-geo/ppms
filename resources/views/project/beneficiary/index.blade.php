@extends('backend.layouts.app')
@section('title')
    Project Beneficiary
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Beneficiary </h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">beneficiary</li>
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
                                <h3 class="card-title">Projects Beneficiary</h3>
                                
                                <?php

                                $permission = helperPermissionLink(url('project/beneficiary/create'), url('project/beneficiary'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                             {!! Form::open(['method'=>'get','url'=>'/project/beneficiary', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group col-md-3 pull-left">
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                            {!! Form::close() !!}
                                <button class="btn btn-success pull-right" onclick="exportData()" style=" height:42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                            </div>
                            <div class="card-body">
                                @if(!count($beneficiaries)<=0)
                                        <div class="col-md-12" style="overflow-x:auto;">
                                            <table id="example"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                 <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Subproject Name</th>
                                                @endif
                                            <th colspan="24" style="font-weight: bold;">HH & Population by Ethnicity/Sex</th>
                                                <th>Status</th>
                                            <th style="width: 60px !important;" class="text-right">Action</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                  @if (auth()->user()->user_group_id != 2 )
                                                <th></th>
                                                @endif
                                                <th colspan="4" style="font-weight: bold;">Braman/Chhetri</th>                            
                                                <th colspan="4" style="font-weight: bold;">Janajati</th>                            
                                                <th colspan="4" style="font-weight: bold;">Dalit</th>                            
                                                <th colspan="4" style="font-weight: bold;">Muslim</th>                            
                                                <th colspan="4" style="font-weight: bold;">Others</th>  
                                                <th colspan="4" style="font-weight: bold;">Total</th> 
                                                <th></th>
                                                <th></th>
                       
                                            </tr>
                                            <tr>
                                                <th></th>
                                                 @if (auth()->user()->user_group_id != 2)
                                                <th></th>
                                                @endif
                                                @for($i = 1; $i <=6; $i++)
                                                    <th style="font-weight: bold;">HH</th>
                                                    <th style="font-weight: bold;">M</th>
                                                    <th style="font-weight: bold;">F</th>
                                                    <th style="font-weight: bold;">T</th>
                                                @endfor
                                                <th colspan="3"></th>
                                           
                       
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; 
                                                $col_bramin_hh=0;
                                                      $col_bramin_m=0;
                                                      $col_bramin_f=0;
                                                      $col_bramin_t=0;

                                                      $col_janjati_hh=0;
                                                      $col_janjati_m=0;
                                                      $col_janjati_f=0;
                                                      $col_janjati_t=0;

                                                      $col_dalit_hh=0;
                                                      $col_dalit_m=0;
                                                      $col_dalit_f=0;
                                                      $col_dalit_t=0;

                                                      $col_muslim_hh=0;
                                                      $col_muslim_m=0;
                                                      $col_muslim_f=0;
                                                      $col_muslim_t=0;

                                                      $col_other_hh=0;
                                                      $col_other_m=0;
                                                      $col_other_f=0;
                                                      $col_other_t=0;

                                                      $row_hh=0;
                                                      $row_m=0;
                                                      $row_f=0;
                                                      $row_t=0;
                                                ?>
                                               

                                                @foreach($beneficiaries as $key=>$beneficiary)
                                                @foreach($beneficiary as $val)
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                    <?php $bramin_t=$val->bramin_hh+$val->bramin_m+$val->bramin_f ;?>
                                                    <td>{{$val->bramin_hh?$val->bramin_hh:0}}</td>
                                                    <td>{{$val->bramin_m?$val->bramin_m:0}}</td>
                                                    <td>{{$val->bramin_f?$val->bramin_f:0}}</td>
                                                    <td style="font-weight: bold">{{$bramin_t}}</td>

                                                    <?php $janajati_t= $val->janjati_hh+$val->janjati_m+$val->janjati_f; ?>
                                                    <td>{{$val->janjati_hh?$val->janjati_hh:0}}</td>
                                                    <td>{{$val->janjati_m?$val->janjati_m:0}}</td>
                                                    <td>{{$val->janjati_f?$val->janjati_f:0}}</td>
                                                    <td style="font-weight: bold">{{$janajati_t}}</td>

                                                    <?php $dalit_t=$val->dalit_hh+$val->dalit_m+$val->dalit_f; ?>
                                                    <td>{{$val->dalit_hh?$val->dalit_hh:0}}</td>
                                                    <td>{{$val->dalit_m?$val->dalit_m:0}}</td>
                                                    <td>{{$val->dalit_f?$val->dalit_f:0}}</td>
                                                    <td style="font-weight: bold">{{$dalit_t}}</td>

                                                    <?php $muslim_t=$val->muslim_hh+$val->muslim_m+$val->muslim_f; ?>
                                                    <td>{{$val->muslim_hh?$val->muslim_hh:0}}</td>
                                                    <td>{{$val->muslim_m?$val->muslim_m:0}}</td>
                                                    <td>{{$val->muslim_f?$val->muslim_f:0}}</td>
                                                    <td style="font-weight: bold">{{$muslim_t}}</td>


                                                    <?php $other_t=$val->other_hh+$val->other_m+$val->other_f;?>
                                                    <td>{{$val->other_hh?$val->other_hh:0}}</td>
                                                    <td>{{$val->other_m?$val->other_m:0}}</td>
                                                    <td>{{$val->other_f?$val->other_f:0}} </td>
                                                    <td style="font-weight: bold">{{$other_t}}</td>

                                                    <?php 
                                                    $total_hh=$val->bramin_hh+$val->janjati_hh+$val->dalit_hh+$val->muslim_hh+$val->other_hh;
                                                    $total_m=$val->bramin_m+$val->janjati_m+$val->dalit_m+$val->muslim_m+$val->other_m;
                                                    $total_f=$val->bramin_f+$val->janjati_f+$val->dalit_f+$val->muslim_f+$val->other_f;
                                                    $total_t=$bramin_t+$janajati_t+$dalit_t+$muslim_t+$other_t;
                                                     ?>
                                                     <td  style="font-weight: bold" >{{$total_hh}}</td>
                                                     <td style="font-weight: bold">{{$total_m}}</td>
                                                     <td style="font-weight: bold">{{$total_f}}</td>
                                                     <td style="font-weight: bold">{{$total_t}}</td>
                                                     <td ><span id="dynamicStatus_{{$val->id}}" class="color-{{($val->status=='submitted')?'grey':(($val->status=='approved')?'green':(($val->status=='canceled')?'red':'peru'))}}">{{ucfirst($val->status)}}</span></td>
                                                     <td class="text-right row" style="margin-right: 0px;" id="action_{{ $val->id }}">
                                                        @if($val->status!='approved' || auth()->user()->user_group_id!=2 && auth()->user()->user_group_id != 3)
                                                        @if($allowEdit)
                                                            <a href="{{route('beneficiary.edit',[$val->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif

                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['beneficiary.destroy',
                                                                $val->id],'class'=> 'inline']) !!}
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top" title="Delete"
                                                                    onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>&nbsp;

                                                            {!! Form::close() !!}
                                                        @endif
                                                        @if(auth()->user()->user_group_id==3)
                                                          <button type="button" class="btn btn-outline-primary btn-xs pull-right boxTopButton" data-toggle="modal" data-target="#status_{{$val->id}}">
                                                                 <i class="fa fa-eye"></i>
                                                            </button>
                                                        
                                                         @include('project.layouts.approveStatusModel')
                                                        @endif
                                                        @endif

                                                        

                                                    </td>

                                                     <?php
                                                      $col_bramin_hh+=$val->bramin_hh;
                                                      $col_bramin_m+=$val->bramin_m;
                                                      $col_bramin_f+=$val->bramin_f;
                                                      $col_bramin_t+=$bramin_t;

                                                      $col_janjati_hh+=$val->janjati_hh;
                                                      $col_janjati_m+=$val->janjati_m;
                                                      $col_janjati_f+=$val->janjati_f;
                                                      $col_janjati_t+=$janajati_t;

                                                      $col_dalit_hh+=$val->dalit_hh;
                                                      $col_dalit_m+=$val->dalit_m;
                                                      $col_dalit_f+=$val->dalit_f;
                                                      $col_dalit_t+=$dalit_t;

                                                      $col_muslim_hh+=$val->muslim_hh;
                                                      $col_muslim_m+=$val->muslim_m;
                                                      $col_muslim_f+=$val->muslim_f;
                                                      $col_muslim_t+=$muslim_t;

                                                      $col_other_hh+=$val->other_hh;
                                                      $col_other_m+=$val->other_m;
                                                      $col_other_f+=$val->other_f;
                                                      $col_other_t+=$other_t;

                                                      $row_hh+=$total_hh;
                                                      $row_m+=$total_m;
                                                      $row_f+=$total_f;
                                                      $row_t+=$total_t;
                                                      ?>


                                                </tr>
                                                    <?php $i++; ?>

                                                @endforeach
                                                @endforeach
                                                <tr>
                                                    <td colspan="2" style="font-weight: bold; text-align:center;">Total</td>
                                                   <td style="font-weight: bold" > {{$col_bramin_hh}}</td>
                                                    <td style="font-weight: bold" >{{$col_bramin_m}}</td>
                                                    <td style="font-weight: bold" >{{$col_bramin_f}}</td>
                                                    <td style="font-weight: bold">{{$col_bramin_t}}</td>

                                                    <td style="font-weight: bold">{{$col_janjati_hh}}</td>
                                                    <td style="font-weight: bold">{{$col_janjati_m}}</td>
                                                    <td style="font-weight: bold">{{$col_janjati_f}}</td>
                                                    <td style="font-weight: bold">{{$col_janjati_t}}</td>

                                                    <td style="font-weight: bold">{{$col_dalit_hh}}</td>
                                                    <td style="font-weight: bold">{{$col_dalit_m}}</td>
                                                    <td style="font-weight: bold">{{$col_dalit_f}}</td>
                                                    <td style="font-weight: bold">{{$col_dalit_t}}</td>

                                                    <td style="font-weight: bold">{{$col_muslim_hh}}</td>
                                                   <td style="font-weight: bold"> {{$col_muslim_m}}</td>
                                                    <td style="font-weight: bold">{{$col_muslim_f}}</td>
                                                    <td style="font-weight: bold">{{$col_muslim_t}}</td>

                                                    <td style="font-weight: bold">{{$col_other_hh}}</td>
                                                    <td style="font-weight: bold">{{$col_other_m}}</td>
                                                    <td style="font-weight: bold">{{$col_other_f}}</td>
                                                    <td style="font-weight: bold">{{$col_other_t}}</td>

                                                    <td style="font-weight: bold">{{$row_hh}}</td>
                                                    <td style="font-weight: bold">{{$row_m}}</td>
                                                    <td style="font-weight: bold">{{$row_f}}</td>
                                                    <td style="font-weight: bold">{{$row_t}}</td>
                                                    <td></td>
                                                    <td></td>
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
    // $(document).ready(function() {
    //     $('#example').DataTable( {
    //         "scrollX": true,
    //     });
    // });

    </script>
        <script>
            function sendRequest(ben_id) {
                var status_id = 'statusdetail_' + ben_id;
                var comment_id = 'comments_' + ben_id;
                var status = document.getElementById(status_id).value;
                var comment = document.getElementById(comment_id).value;
                $('.modal').modal('hide');


                $.ajax({
                    type: 'post',
                    url: baseurl + '/project/beneficiary/beneficiaryStatus',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'beneficiary_id': ben_id,
                        'status': status,
                        'comment': comment,
                    },
                    success: function(data) {
                        var color = status == 'approved' ? 'green' : status == 'canceled' ? 'red' : 'peru';
                        document.getElementById(comment_id).value='';
                        $('#dynamicStatus_' + ben_id).html('');
                        $('#dynamicStatus_' + ben_id).html(status.charAt(0).toUpperCase()+status.slice(1));
                        $('#dynamicStatus_' + ben_id).removeClass().addClass('color-' + color);
                        if(status=='approved'){
                        $('#action_'+ben_id).hide();
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
        // var url =  baseurl + '/exports/beneficiaryExport'+'?project_id='+project_id;
        var url =  baseurl + '/project/beneficiary'+'?project_id='+project_id+'&export=export';
        window.location = url;
    }

</script>


@endsection