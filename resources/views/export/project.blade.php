<table border="1px">
    <thead>
        <tr>
            <th colspan="10" style="text-align: center; font-weight:bold; ">Project Details</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">S.N</th>
            <th style="font-weight: bold;">Region</th>
            <th style="font-weight: bold;">Name</th>
            <th style="font-weight: bold;">Package Number</th>
            <th style="font-weight: bold;">Sector</th>
            <th style="font-weight: bold;">Reporting Fiscal Year</th>
            <th style="font-weight: bold;">Project Start Fiscal Year</th>
            <th style="font-weight: bold;">District</th>
            <th style="font-weight: bold;">Municipality</th>
            <th style="font-weight: bold;">Ward</th>
        </tr>
      
       
    </thead>
    <tbody>
        @foreach ($projects as $key => $data)
        <?php $rowcount= count($data->address); ?>
        @foreach($data->address as $key1=>$address)  
            <tr>
                @if(!$key1)
                <th scope=row rowspan="{{$rowcount}}">{{ $key + 1 }}</th>
                <td rowspan="{{$rowcount}}">{{$data->region->region_name }}</td>
                <td rowspan="{{$rowcount}}">{{$data->name}}</td>
                <td rowspan="{{$rowcount}}">{{$data->package_no}}</td>
                <td rowspan="{{$rowcount}}">{{($data->sector=='water_supply')?'Water Supply':(($data->sector=='sanitation')?'Sanitation':'Drainage')}} </td>
                <td rowspan="{{$rowcount}}"> {{$data->reportingFY->fy_name}}</td>
                <td rowspan="{{$rowcount}}">{{$data->projectStartFY->fy_name}}</td>
                @endif
                    <td>{{$address->district->english_name}}</td>
                    <td>{{$address->municipality->muni_name}}</td>
                    <td>{{$address->ward_no}}</td>
                </tr>
                @endforeach
        @endforeach
    </tbody>
</table>
