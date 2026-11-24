@extends('backend.layouts.app')
@section('title')
Project Environmental Record 
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Environmental Record Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">EnvironmentalRecord</li>
                            <li class="breadcrumb-item active">Show</li>
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

                         <nav class="nav nav-tabs">
                            <a class="nav-item nav-link active" href="#safeguard" data-toggle="tab"><b>Safeguard</b></a>
                            <a class="nav-item nav-link" href="#env" data-toggle="tab"><b>Environmental</b></a>
                            <a class="nav-item nav-link" href="#risk" data-toggle="tab"><b>Risk Assessment</b></a>
                            <a class="nav-item nav-link" href="#safety" data-toggle="tab"><b>Safety and Health Facility</b></a>
                            <a class="nav-item nav-link" href="#community" data-toggle="tab"><b> Community Safety</b></a>
                            <a class="nav-item nav-link" href="#issue" data-toggle="tab"><b> Issues and Corrective Actions</b></a>
                            
                        </nav>
                    </div>
                    <div class="card-body">
                    {{-- {!! Form::open(['method' => 'post', 'url' => '/project/env_monthly_approve', 'autocomplete' => 'off',  'role' => 'form']) !!} --}}
                        
                        <div class="tab-content">
                            <div class="row ml-1">
                               <h5>Year: <strong>{{$year}}</strong></h5> &nbsp;&nbsp;&nbsp;&nbsp;
                               <h5>Month: <strong>{{$month}}</strong> </h5>
                            
                           </div>
                            <div class="tab-pane in active" id="safeguard">
                                <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Safeguard Monitoring Indicators</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                     @if(auth()->user()->user_group_id==3)
                                                    <th>Approve Status</th>
                                                    <th>Comment</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($empMonitoringLists as $empData)
                                                <input type="hidden" name="year" value="{{$year}}">
                                                <input type="hidden" name="month" value="{{$month}}">
                                                <input type="hidden" name="project_id" value="{{$proj_id}}">
                                                @if(isset($details[$empData->id]))
                                                <tr>
                                                    <th style="width: 290px;">{{$empData->title}}</th>
                                                    <td>{{$details[$empData->id][0]['status']=='y'?'Yes':'No'}} </td>
                                                    <td>{{$details[$empData->id][0]['result']}} </td>
                                                    <td>{{$details[$empData->id][0]['remarks']}} </td>
                                                    <td>
                                                        @if($details[$empData->id][0]['file']!=null)
                                                         <?php $extension = explode('.', $details[$empData->id][0]['file']); ?>
                                                        @if ($extension[1] == 'pdf')
                                                        <a href="{{ asset('storage/uploads/environmental/' . $details[$empData->id][0]['file']) }}"
                                                            target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                      @else
                                                      <a href="{{ asset('storage/uploads/environmental/' . $details[$empData->id][0]['file']) }}"
                                                        target="_blank"> <img src="{{ asset('storage/uploads/environmental/' . $details[$empData->id][0]['file']) }}" style="height:100px;"></a>
                                                        @endif
                                                        @else
                                                            No File available
                                                         @endif
                                                    </td>
                                                     @if(auth()->user()->user_group_id==3)
                                                    <td> 
                                                <select class=" form-control select2" name="details[{{ $empData->id}}][status]" id="statusdetail_{{ $empData->id}}">
                                                    <option value="" >Select</option>
                                                    <option value="approved" {{$details[$empData->id][0]['approve_status']=='approved'?'selected':''}}>Approved</option>                                                                       
                                                    <option value="revision" {{$details[$empData->id][0]['approve_status']=='revision'?'selected':''}}>Revision</option>                
                                                    <option value="canceled" {{$details[$empData->id][0]['approve_status']=='canceled'?'selected':''}}>Canceled</option>                                                   
                                                </select>
                                                 </td>
                                                   <td>
                                              <textarea name="details[{{ $empData->id }}][comments]" class="form-control view" placeholder="Write comment" id="comments_{{ $empData->id }}" rows="2" cols="20"></textarea>
                                                 </td>
                                                 @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="env">
                                <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Environmental Monitoring Results </strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                     @if(auth()->user()->user_group_id==3)
                                                    <th>Approve Status</th>
                                                    <th>Comment</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($envMonitoringLists as $envMoni)
                                                @if(isset($details[$envMoni->id]))
                                                <tr>
                                                    <th style="width: 290px;">{{$envMoni->title}}</th>
                                                    <td>{{$details[$envMoni->id][0]['status']=='y'?'Yes':'No'}} </td>
                                                    <td>{{$details[$envMoni->id][0]['result']}} </td>
                                                    <td>{{$details[$envMoni->id][0]['remarks']}} </td>
                                                    <td>
                                                        @if($details[$envMoni->id][0]['file']!=null)
                                                         <?php $extension = explode('.', $details[$envMoni->id][0]['file']); ?>
                                                        @if ($extension[1] == 'pdf')
                                                        <a href="{{ asset('storage/uploads/environmental/' . $details[$envMoni->id][0]['file']) }}"
                                                            target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                      @else
                                                      <a href="{{ asset('storage/uploads/environmental/' . $details[$envMoni->id][0]['file']) }}"
                                                        target="_blank"> <img src="{{ asset('storage/uploads/environmental/' . $details[$envMoni->id][0]['file']) }}" style="height:100px;" ></a>
                                                        @endif
                                                        @else
                                                            No File available
                                                         @endif
                                                    </td>
                                                     @if(auth()->user()->user_group_id==3)
                                                        <td> 
                                                <select class=" form-control select2" name="details[{{ $envMoni->id}}][status]" id="statusdetail_{{ $envMoni->id}}">
                                                    <option value="" >Select</option>
                                                    <option value="approved" {{$details[$envMoni->id][0]['approve_status']=='approved'?'selected':''}}>Approved</option>                                                                       
                                                    <option value="revision" {{$details[$envMoni->id][0]['approve_status']=='revision'?'selected':''}}>Revision</option>                
                                                    <option value="canceled" {{$details[$envMoni->id][0]['approve_status']=='canceled'?'selected':''}}>Canceled</option>                                                   
                                                </select>
                                                 </td>
                                                   <td>
                                              <textarea name="details[{{ $envMoni->id }}][comments]" class="form-control view" placeholder="Write comment" id="comments_{{ $envMoni->id }}" rows="2" cols="20"></textarea>
                                                 </td>
                                                 @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="risk">
                                <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Risk assessment of various activities</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                     @if(auth()->user()->user_group_id==3)
                                                    <th>Approve Status</th>
                                                    <th>Comment</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($riskLists as $risk)
                                                @if(isset($details[$risk->id]))
                                                <tr>
                                                    <th style="width: 290px;">{{$risk->title}}</th>
                                                    <td>{{$details[$risk->id][0]['status']=='y'?'Yes':'No'}} </td>
                                                    <td>{{$details[$risk->id][0]['result']}} </td>
                                                    <td>{{$details[$risk->id][0]['remarks']}} </td>
                                                    <td>
                                                        @if($details[$risk->id][0]['file']!=null)
                                                           <?php $extension = explode('.', $details[$risk->id][0]['file']); ?>
                                                        @if ($extension[1] == 'pdf')
                                                        <a href="{{ asset('storage/uploads/environmental/' . $details[$risk->id][0]['file']) }}"
                                                            target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                      @else
                                                      <a href="{{ asset('storage/uploads/environmental/' . $details[$risk->id][0]['file']) }}"
                                                        target="_blank"> <img src="{{ asset('storage/uploads/environmental/' . $details[$risk->id][0]['file']) }}" style="height:100px;"></a>
                                                        @endif
                                                        @else
                                                            No File available
                                                         @endif
                                                    </td>
                                                     @if(auth()->user()->user_group_id==3)
                                                       <td> 
                                                <select class=" form-control select2" name="details[{{ $risk->id}}][status]" id="statusdetail_{{ $risk->id}}">
                                                    <option value="" >Select</option>
                                                    <option value="approved" {{$details[$risk->id][0]['approve_status']=='approved'?'selected':''}}>Approved</option>                                                                       
                                                    <option value="revision" {{$details[$risk->id][0]['approve_status']=='revision'?'selected':''}}>Revision</option>                
                                                    <option value="canceled" {{$details[$risk->id][0]['approve_status']=='canceled'?'selected':''}}>Canceled</option>                                                   
                                                </select>
                                                 </td>
                                                   <td>
                                              <textarea name="details[{{ $risk->id }}][comments]" class="form-control view" placeholder="Write comment" id="comments_{{ $risk->id }}" rows="2" cols="20"></textarea>
                                                 </td>
                                                 @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="safety">
                                <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>The Safety and Health Facility</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                     @if(auth()->user()->user_group_id==3)
                                                    <th>Approve Status</th>
                                                    <th>Date</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($safetyLists as $safety)
                                                @if(isset($details[$safety->id]))
                                                <tr>
                                                    <th style="width: 290px;">{{$safety->title}}</th>
                                                    <td>{{$details[$safety->id][0]['status']=='y'?'Yes':'No'}} </td>
                                                    <td>{{$details[$safety->id][0]['result']}} </td>
                                                    <td>{{$details[$safety->id][0]['remarks']}} </td>
                                                    <td>
                                                        @if($details[$safety->id][0]['file']!=null)
                                                            <?php $extension = explode('.', $details[$safety->id][0]['file']); ?>
                                                        @if ($extension[1] == 'pdf')
                                                        <a href="{{ asset('storage/uploads/environmental/' . $details[$safety->id][0]['file']) }}"
                                                            target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                      @else
                                                      <a href="{{ asset('storage/uploads/environmental/' . $details[$safety->id][0]['file']) }}"
                                                        target="_blank"> <img src="{{ asset('storage/uploads/environmental/' . $details[$safety->id][0]['file']) }}" style="height:100px;"></a>
                                                        @endif
                                                        @else
                                                            No File available
                                                         @endif
                                                    </td>
                                                     @if(auth()->user()->user_group_id==3)
                                                       <td> 
                                                <select class=" form-control select2" name="details[{{ $safety->id}}][status]" id="statusdetail_{{ $safety->id}}">
                                                    <option value="" >Select</option>
                                                    <option value="approved" {{$details[$safety->id][0]['approve_status']=='approved'?'selected':''}}>Approved</option>                                                                       
                                                    <option value="revision" {{$details[$safety->id][0]['approve_status']=='revision'?'selected':''}}>Revision</option>                
                                                    <option value="canceled" {{$details[$safety->id][0]['approve_status']=='canceled'?'selected':''}}>Canceled</option>                                                   
                                                </select>
                                                 </td>
                                                   <td>
                                              <textarea name="details[{{ $safety->id }}][comments]" class="form-control view" placeholder="Write comment" id="comments_{{ $safety->id }}" rows="2" cols="20"></textarea>
                                                 </td>
                                                 @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="community">
                                <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Community Safety</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                     @if(auth()->user()->user_group_id==3)
                                                    <th>Approve Status</th>
                                                    <th>Date</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($communityLists as $community)
                                                @if(isset($details[$community->id]))
                                                <tr>
                                                    <th style="width: 290px;">{{$community->title}}</th>
                                                    <td>{{$details[$community->id][0]['status']=='y'?'Yes':'No'}} </td>
                                                    <td>{{$details[$community->id][0]['result']}} </td>
                                                    <td>{{$details[$community->id][0]['remarks']}} </td>
                                                    <td>
                                                        @if($details[$community->id][0]['file']!=null)
                                                        <?php $extension = explode('.', $details[$community->id][0]['file']); ?>
                                                        @if ($extension[1] == 'pdf')
                                                        <a href="{{ asset('storage/uploads/environmental/' . $details[$community->id][0]['file']) }}"
                                                            target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                      @else
                                                      <a href="{{ asset('storage/uploads/environmental/' . $details[$community->id][0]['file']) }}"
                                                        target="_blank"><img src="{{ asset('storage/uploads/environmental/' . $details[$community->id][0]['file']) }}" style="height:100px;"></a>
                                                        @endif
                                                        @else
                                                            No File available
                                                         @endif
                                                    </td>
                                                     @if(auth()->user()->user_group_id==3)
                                                       <td> 
                                                <select class=" form-control select2" name="details[{{ $community->id}}][status]" id="statusdetail_{{ $community->id}}">
                                                    <option value="" >Select</option>
                                                    <option value="approved" {{$details[$community->id][0]['approve_status']=='approved'?'selected':''}}>Approved</option>                                                                       
                                                    <option value="revision" {{$details[$community->id][0]['approve_status']=='revision'?'selected':''}}>Revision</option>                
                                                    <option value="canceled" {{$details[$community->id][0]['approve_status']=='canceled'?'selected':''}}>Canceled</option>                                                   
                                                </select>
                                                 </td>
                                                   <td>
                                              <textarea name="details[{{ $community->id }}][comments]" class="form-control view" placeholder="Write comment" id="comments_{{ $community->id }}" rows="2" cols="20"></textarea>
                                                 </td>
                                                 @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="issue">
                                <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Issues and Corrective Actions</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th>Issue/Concern</th>
                                                    <th>Corrective Action</th>
                                                    <th>Responsible Body</th>
                                                    <th>Target Timeline</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                     @if(auth()->user()->user_group_id==3)
                                                    <th>Approve Status</th>
                                                    <th>Comment</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($issuesLists as $issue)
                                                @if(isset($details[$issue->id]))
                                                <tr>
                                                    <td>{{$details[$issue->id][0]['issue']}} </td>
                                                    <td>{{$details[$issue->id][0]['action']}} </td>
                                                    <td>{{$details[$issue->id][0]['responsible_body']}} </td>
                                                    <td>{{$details[$issue->id][0]['target_time']}} </td>

                                                    <td>{{$details[$issue->id][0]['status']=='y'?'Yes':'No'}} </td>
                                                    <td>{{$details[$issue->id][0]['remarks']}} </td>
                                                    <td>
                                                        @if($details[$issue->id][0]['file']!=null)
                                                               <?php $extension = explode('.', $details[$issue->id][0]['file']); ?>
                                                        @if ($extension[1] == 'pdf')
                                                        <a href="{{ asset('storage/uploads/environmental/' . $details[$issue->id][0]['file']) }}"
                                                            target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                      @else
                                                      <a href="{{ asset('storage/uploads/environmental/' . $details[$issue->id][0]['file']) }}"
                                                        target="_blank"> <img src="{{ asset('storage/uploads/environmental/' . $details[$issue->id][0]['file']) }}" style="height:100px;"></a>
                                                        @endif
                                                        @else
                                                            No File available
                                                         @endif
                                                    </td>
                                                     @if(auth()->user()->user_group_id==3)
                                                 <td> 
                                                <select class=" form-control select2" name="details[{{ $issue->id}}][status]" id="statusdetail_{{ $issue->id}}">
                                                    <option value="" >Select</option>
                                                    <option value="approved" {{$details[$issue->id][0]['approve_status']=='approved'?'selected':''}}>Approved</option>                                                                       
                                                    <option value="revision" {{$details[$issue->id][0]['approve_status']=='revision'?'selected':''}}>Revision</option>                
                                                    <option value="canceled" {{$details[$issue->id][0]['approve_status']=='canceled'?'selected':''}}>Canceled</option>                                                   
                                                </select>
                                                 </td>
                                                   <td>
                                              <textarea name="details[{{ $issue->id }}][comments]" class="form-control view" placeholder="Write comment" id="comments_{{ $issue->id }}" rows="2" cols="20"></textarea>
                                                 </td>
                                                 @endif
                                                </tr>
                                                @endif
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                          
                            
                        
                        </div>
                              {{-- <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{url('/project/environmental_monthly_record')}}" class="btn btn-danger">Cancel</a>
                        
                    </div> --}}
                            
                            {{-- {!! Form::close() !!} --}}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection
