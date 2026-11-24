<table>
    <thead>
        <tr>
            <th colspan="10" style="font-weight: bold;text-align: center;">Issues/Meeting Details</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">S.N</th>
            @if(auth()->user()->user_group_id != 2)  
            <th style="font-weight: bold;">Project Name</th>
            @endif
            <th style="font-weight: bold;">Category</th>
            <th style="font-weight: bold;">Number</th>
            <th style="font-weight: bold;">Issue</th>
            <th style="font-weight: bold;">Participation</th>
            <th style="font-weight: bold;">Reason</th>
            <th style="font-weight: bold;">Responsibility</th>
            <th style="font-weight: bold;">Action</th>
            <th style="font-weight: bold;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach ($issues as $key => $issue)
            @foreach ($issue as $val)

                <tr>
                    <th scope=row>{{ $i }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $val->project->name }}</td>
                    @endif
                    <td style="text-transform: capitalize;font-weight: bold;">{{ $val->category }}</td>
                    <td>{{ $val->number }}</td>
                    <td>{{ $val->issue }}</td>
                    <td>{{ $val->participation != null ? $val->participation : '-' }}</td>
                    <td>{{ $val->reason != null ? $val->reason : '-' }}</td>
                    <td>{{ $val->responsibility != null ? $val->responsibility : '-' }}</td>
                    <td>{{ $val->action != null ? $val->action : '-' }}</td>
                    <td>{{ $val->status != null ? $val->status : '-' }}</td>
                </tr>
                <?php $i++; ?>

            @endforeach
        @endforeach

    </tbody>
</table>
