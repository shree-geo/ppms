<table>
    <thead>
        <tr>
            <th colspan=7 style="font-weight: bold;text-align: center;">Monitorings Detail</th>
        </tr>
        <tr>
            <th style="width: 10px; font-weight:bold;">S.n</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th style="font-weight: bold;">Date</th>
            <th style="font-weight: bold;">Type</th>
            <th style="font-weight: bold;">Lead By</th>
            <th style="font-weight: bold;">Number of Participants</th>
        </tr>
    </thead>


    <tbody>

        <?php $i = 1; ?>
        @foreach ($monitorings as $key => $monitoring)
            @foreach ($monitoring as $val)
                <tr>
                    <th>{{ $i }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $val->project->name }}</td>
                    @endif
                    <td>{{ $val->date }}</td>
                    <td>{{ $val->type }}</td>
                    <td>{{ $val->leadBy }}</td>
                    <td>{{ $val->no_of_participant }}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
        @endforeach
    </tbody>
</table>
