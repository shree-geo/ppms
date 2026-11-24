<?php

use Illuminate\Database\Seeder;

class ProgramTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('program_types')->truncate();
        $rows = [
            [
                'type_name' => 'Training'
            ],
            [
                'type_name' => 'Orientation'
            ],
            [
                'type_name' => 'Consultation'
            ],
            [
                'type_name' => 'Public Awarness'
            ],
            [
                'type_name' => 'Meeting'
            ],
            [
                'type_name' => 'School Wash Program'
            ]
        ];
        DB::table('program_types')->insert($rows);
    }
}
