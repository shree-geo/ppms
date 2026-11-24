<?php

use Illuminate\Database\Seeder;

class ProjectRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_regions')->truncate();
        $rows = [
            [
                'region_name' => 'Eastern'
            ],
            [
                'region_name' => 'Central'
            ],
            [
                'region_name' => 'Western'
            ]
        ];
        DB::table('project_regions')->insert($rows);
    }
}
