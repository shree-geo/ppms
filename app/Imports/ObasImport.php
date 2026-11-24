<?php

namespace App\Imports;

use App\Models\Configurations\District;
use App\Models\Oba;
use App\Models\ObaDetails;
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
    private $oba_id;
    
    public function __construct($oba_id)
    {
        $this->oba_id = $oba_id;
    }
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
       
        $value=ObaDetails::where('obas_id',$this->oba_id)->where('owner_name',$row[1])->first();
        // dd($value);
        
        $data = [
            'obas_id'=>$this->oba_id,
            'owner_name'=>$row[1],
            'casts_id'=>$row[2],
            'family_size'=>$row[3],
            'househead_women'=>$row[4],
            'female_count'=>$row[5],
            'male_count'=>$row[6],
            'oba_status'=>$row[7],
            'start_date'=>$row[8],
            'complete_date'=>$row[9],
            'inuse_date'=>$row[10],
        ];
    if($value==null){

        ObaDetails::create($data);
    }
    }

   
}
