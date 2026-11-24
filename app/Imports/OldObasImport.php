<?php

namespace App\Imports;

use App\Models\Configurations\District;
use App\Models\Oba;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\DistrictRepository;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ObasImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $project_id;
    private $oba_types_id;
    
    public function __construct($project_id, $oba_types_id)
    {
        $this->project_id = $project_id;
        $this->oba_types_id = $oba_types_id;
    }
    public function startRow(): int
    {
        return 3;
    }
    public function model(array $row)
    {

        $monthList = $this->englishMonths();
        $districts=District::all()->pluck('id','english_name');
        $data = [
            'project_id' => $this->project_id,
            'oba_types_id' => $this->oba_types_id,
            'dis_id' => $districts[$row[3]],
            'year' => $row[4],
            'months' => $monthList[$row[5]],
            'remarks' => '',
            'status' => $row['6'] == 'Submitted' ? 'submitted' : ($row[6] == 'Approved' ? 'approved' : ($row[6] == 'Canceled' ? 'canceled' : 'rejected')),
            'status_date' => '2022-02-18',
        ];

        Oba::create($data);
    }

    public function englishMonths()
    {
        $result = [
            'January' => '1',
            'February' => '2',
            'March' => '3',
            'April' => '4',
            'May' => '5',
            'June' => '6',
            'July' => '7',
            'August' => '8',
            'September' => '9',
            'October' => '10',
            'November' => '11',
            'December' => '12',
        ];
        return $result;
    }
}
