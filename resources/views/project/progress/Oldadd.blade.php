@extends('backend.layouts.app')
@section('title')
    Projects Progress Data
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Progress Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Progress Data</li>
                            <li class="breadcrumb-item active">{{trans('app.add')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <div class="form">
                <div class="card card-default">
                    <div class="card-header with-border">
                        <h3 class="card-title">{{trans('app.add')}}</h3>
                        <?php

                        $permission = helperPermissionLink(url('project/progressData/create'), url('project/progressData'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                       
                    </div>
                    <div class="card-body">
                        @if($allowAdd)

                            {!! Form::open(['method'=>'post','url'=>'/project/progressData', 'autocomplete'=>'off', 'role'=>'form','files'=>'true','enctype' => 'multipart/form-data']) !!}
                            
                                <div class="row">
                                    @if(auth()->user()->user_group_id!=2)
                                    <div class="form-group col-md-6 {{ ($errors->has('project_id'))?'has-error':'' }}">
                                            <label>Subproject<label class="text-danger">*</label></label>
                                            {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                            'Select Project Name'])}}
                                            {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                     @endif
                                </div>
                                <div class="row">
                                   
                                <div class="form-group col-md-6 {{ ($errors->has('contract_start_date'))?'has-error':'' }}">
                                    <label>Contract Start Date</label>
                                    {!! Form::text('contract_start_date',$project['contract_signing_date'],['class'=>'form-control','placeholder' => 'Start Date','id'=>'contract_start_date','readonly']) !!}
                                    {!! $errors->first('contract_start_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('contract_end_date'))?'has-error':'' }}">
                                    <label>Contract End Date</label>
                                    {!! Form::text('contract_end_date',$project['latest_eot'],['class'=>'form-control','placeholder' => 'End Date','id'=>'contract_end_date','readonly']) !!}
                                    {!! $errors->first('contract_end_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                <?php  $target_count=0;
                                       $progress_count=0;
                                       $dispercement_count=0;
                                        ?>
                                @foreach($month_list as $key=>$months)
                                <div class="row">
                                <div class="col-md-12">
                                 <table class="table table-bordered table-hover" id="hideTable"  >
                                            <thead>
                                                <tr>
                                                    <th>Year</th>
                                                    <th>Month</th>
                                                    <th>Initial target</th>
                                                    @if(count($target[$key])>0)<th>Initial Target Cumulative</th>
                                                    <th>Progress</th>
                                                    <th>Progress Cumulative</th>
                                                    <th>Financial Progress</th>
                                                    <th>Dispercement</th>
                                                    <th>Dispercement Cumulative</th>
                                                    @endif

                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="progressTable">
                                             @foreach($months as $year=>$data)
                                             @foreach($data as $key1=>$val)
                                             <tr>
                                                 <td>{{$year}}</td>
                                                 <td>{{$val}}</td> 
                                                 @if($target!=null && (isset($target[$key][$year])))
                                                 @foreach($target[$key][$year] as $tar)
                                                 @if($tar->month==$val)
                                                 <?php  
                                                     $target_count+=$tar->target;
                                                     $progress_count+=$tar->progress;
                                                     $dispercement_count+=$tar->dispercement;
                                                     ?>
                                                 <td> {{ Form::text('total['.$key.']['.$year.']['.$val.']', $tar->target, ['class' => 'form-control', 'style'=>'width:100%;']) }}</td>
                                                 <td>{{ Form::text('target_count', $target_count, ['class' => 'form-control', 'style'=>'width:100%;','readonly']) }}</td>
                                                 <td> {{ Form::text('progress['.$key.']['.$year.']['.$val.']', $tar->progress, ['class' => 'form-control', 'style'=>'width:100%;']) }}</td>
                                                 <td>{{ Form::text('target_count', $progress_count, ['class' => 'form-control', 'style'=>'width:100%;','readonly']) }}</td>
                                                 <td> {{ Form::text('financial['.$key.']['.$year.']['.$val.']', $tar->financial_progress, ['class' => 'form-control', 'style'=>'width:100%;']) }}</td>
                                                 <td> {{ Form::text('dispercement['.$key.']['.$year.']['.$val.']', $tar->dispercement, ['class' => 'form-control', 'style'=>'width:100%;', auth()->user()->user_group_id!=1?'readonly':'']) }}</td>
                                                 <td>{{ Form::text('dispercement_count', $dispercement_count, ['class' => 'form-control', 'style'=>'width:100%;','readonly']) }}</td>

                                                 @endif
                                                 @endforeach
                                                 @else
                                                 <td> {{ Form::text('total['.$key.']['.$year.']['.$val.']', null, ['class' => 'form-control', 'style'=>'width:100%;']) }}</td>
                                                 
                                                 @endif

                                             </tr>
                                             @endforeach
                                             @endforeach
                                             
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                    
                                </div>
                                @endforeach
                                
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/progressData')}}" class="btn btn-danger">Cancel</a>
                                
                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;
                                </button>
                                You Cannot access this module Please Contact your Super Admin user to access this.
                            </div>

                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection
@section('js')
<script>
     $('#project_id').change(function(){
        var project_id = $('#project_id').val();
          var url = baseurl + '/project/progressDataProjectId'+ '?project_id=' + project_id;
        window.location = url;
    });

</script>
    <script>
        $('#project_id').change(function(){
            var proj_id= $('#project_id').val();
            $.ajax({
                type:'get',
                url:baseurl + '/progress/' + proj_id,
                success:function(res){
                         $('#contract_start_date').val(res.details.contract_signing_date);
                         $('#contract_end_date').val(res.details.latest_eot);
                         $('#progressTable').html('');
                         $('#hideTable').show();

                         for (var key in res.months){
                         for (var year in res.months[key]){
                            if(res.data.length>0){
                                var detail= res.data[key]?res.data[key].target:''; 
                                }else{
                                    var detail='';
                                }  
                             $('#progressTable').append(
                                 `<tr>
                                 <td>${year}</td>
                                 <td>${res.months[key][year]}</td>
                                 <td> {{ Form::text('total[0][${year}][${res.months[key][year]}]','${detail}' , ['class' => 'form-control', 'style'=>'width:100%;']) }}</td>
                                 </tr>  `
                             )
                           
                         }
                         }
                         
                }
            })
        })
    </script>
  @endsection 







