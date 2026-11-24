<table>
    <thead>
        <tr>
            <th colspan=7 style="font-weight: bold;text-align: center;">Members Detail</th>
        </tr>
        <tr>
            <th style="width: 10px; font-weight:bold;">S.n</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th style="font-weight: bold;">Samiti Year</th>
            <th style="font-weight: bold;">Member Name</th>
            <th style="font-weight: bold;">Position</th>
            <th style="font-weight: bold;">Cast</th>
            <th style="font-weight: bold;">Gender</th>
        </tr>
    </thead>


    <tbody>
        <?php $i = 1; ?>
        @foreach ($members as $key => $member_info)
            @foreach ($member_info as $member)
                <tr>
                    <th>{{ $i }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $member->project->name }}</td>
                    @endif
                    <td>{{ $member->samiti_year }}</td>
                    <td>{{ $member->member_name }}</td>
                    <td>{{ $member->position_id == '1' ? 'Chairperson' : ($member->position_id == '2' ? 'Vice Chairperson' : ($member->position_id == '3' ? 'Secretary' : ($member->position_id == '4' ? 'Treasurer' : ($member->position_id == '5' ? 'Member' : '')))) }}
                    </td>
                    <td>{{ $member->member_cast_id == '1' ? 'Brahmin/Chhetry' : ($member->member_cast_id == '2' ? 'Janajati' : ($member->member_cast_id == '3' ? 'Dalit' : ($member->member_cast_id == '4' ? 'Others' : ($member->member_cast_id == '5' ? 'Muslim' : '')))) }}
                    </td>
                    <td>{{ $member->member_gender == 'male' ? 'Male' : 'Female' }}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
        @endforeach
    </tbody>
</table>
