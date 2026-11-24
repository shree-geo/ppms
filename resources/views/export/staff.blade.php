<table>
    <thead>
        <tr>
            <th colspan="12" style="font-weight: bold;text-align: center;">Staff Details</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">S.N</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Project Name</th>
            @endif
            <th style="font-weight: bold;">Office Name</th>
            <th style="font-weight: bold;">Department Name</th>
            <th style="font-weight: bold;">Name</th>
            <th style="font-weight: bold;">Designation</th>
            <th style="font-weight: bold;">Gender</th>
            <th style="font-weight: bold;">Contact Number</th>
            <th style="font-weight: bold;">Email</th>
            <th style="font-weight: bold;">Joined Date</th>
            <th style="font-weight: bold;">End Date</th>
            <th style="font-weight: bold;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach ($staffs as $key => $staff)
            @foreach ($staff as $val)

                <tr>
                    <th scope=row>{{ $i }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $val->project->name }}</td>
                    @endif
                    <th>{{ $val->ofc_name }}</th>
                    <td>{{ $val->department }}</td>
                    <td>{{ $val->name }}</td>
                    {{-- <td>{{$list['designation'][$val->designaion_id] }}</td> --}}
                    <td>{{$val->designation->designation_name}}</td>
                    <td>{{($val->gender=='male')?'Male':(($val->gender=='female')?'Female':'Others')}}</td>
                    <td>{{$val->contact_no}}</td>
                    <td>{{$val->email}}</td>
                    <td>{{$val->join_date}}</td>
                    <td>{{$val->end_date}}</td>
                    <td>{{$val->status=='active'?'Active':'Inactive'}}</td>
                </tr>
                <?php $i++; ?>

            @endforeach
        @endforeach
    </tbody>
</table>
