<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('units')->truncate();
       $rows=[
           [
            'unit_name'=>'Nos',
           ],
           [
               'unit_name'=>'%',
            ],
            [
                'unit_name'=>'Km',
            ],
            [
                'unit_name'=>'Sq.m.',
            ]
            
         
        ];
        DB::table('units')->insert($rows);
    }
}
