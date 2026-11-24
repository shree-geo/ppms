<?php

use Illuminate\Database\Seeder;

class ObaTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oba_types')->truncate();
        $rows = [
            [
                'oba_type_name' => 'Household Toilet Facility'
            ],
            [
                'oba_type_name' => 'Free Piped Water Connection'
            ]
        ];
        DB::table('oba_types')->insert($rows);
    }
}
