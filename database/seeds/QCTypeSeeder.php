<?php

use Illuminate\Database\Seeder;

class QCTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('q_c_types')->truncate();
        $rows = [
            [
                'type_name' => 'QC1'
            ],
            [
                'type_name' => 'QC2'
            ],
            [
                'type_name' => 'QC3'
            ],
            [
                'type_name' => 'QC4'
            ],
            [
                'type_name' => 'QC5'
            ],
            [
                'type_name' => 'QC6'
            ],
            [
                'type_name' => 'QC7'
            ],
            [
                'type_name' => 'QC8'
            ],
            [
                'type_name' => 'QC9'
            ],
            [
                'type_name' => 'QC10'
            ],
        ];
        DB::table('q_c_types')->insert($rows);
    }
}
