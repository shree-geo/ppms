<?php

use Illuminate\Database\Seeder;

class EnvironmentalMonthlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('environmental_monthlies')->truncate();
      $rows=[
          [
              'title'=>'Submission of SS-EMP Monitoring report (Monthly by Contractor )',
              'group_name'=>'ssEmp'
          ],
          [
              'title'=>'Air quality Monitoing results (Bi-Annual)',
              'group_name'=>'environmental'
          ],
          [
              'title'=>'Water quality Monitoring & results (Monthly)',
              'group_name'=>'environmental'
          ],
          [
              'title'=>'Noise quality Monitoring & results (Monthly)',
              'group_name'=>'environmental'
          ],
          [
              'title'=>'Minor Injury',
              'group_name'=>'risk'
          ],
          [
              'title'=>'Major Injury',
              'group_name'=>'risk'
          ],
          [
              'title'=>'Near miss',
              'group_name'=>'risk'
          ],
          [
              'title'=>'Fatal Injury',
              'group_name'=>'risk'
          ],
          [
              'title'=>'Record & Notify of accidents/incidents to RPMO within 24 Hrs',
              'group_name'=>'risk'
          ],
          [
              'title'=>'Emergency Contact Details Available on-site',
              'group_name'=>'risk'
          ],
          [
              'title'=>'MoU Tie-ups with local hospitals/clinics for emergencies Cases',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Safety and health facility for WorkersSafety and health facility for Workers',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Insurance of all Labor done',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Enough PPE Supply & use (gloves/goggles/ safety hat/ safety boots, etc..)',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Safety brefieing to workers by safety officers',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Daily Toolbox talks Conducted on Site',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Separate Toilet facilities for male and female',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Fire fighting Mechanisam, Fire extinguishe (since Welding is prone in the project)',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Drinking water supply available at Site',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Storage areas for chemicals protection',
              'group_name'=>'safety'
          ],
          [
              'title'=>'Emergency Assembly management (incase of earthquake or flood or storm etc)',
              'group_name'=>'safety'
          ],
          [
                  'title'=>'Mockdrills',
                  'group_name'=>'safety'
              ],
              [
                  'title'=>'Training if any:',
                  'group_name'=>'safety'
              ],
          [
              'title'=>'Excavation areas provided with Hard barricades',
              'group_name'=>'community'
          ],
          [
              'title'=>'Safety signages posted around the sites',
              'group_name'=>'community'
          ],
          [
              'title'=>'Temporary and safe walkways for pedestrians available at sites',
              'group_name'=>'community'
          ],
          [
              'title'=>'Record of treated wastewater quality testing/measurement',
              'group_name'=>'community'
          ],
          [
              'title'=>'Kitchen is place away from resident room',
              'group_name'=>'community'
          ],
          [
              'title'=>'Gas Cylinder place outside Kitchen',
              'group_name'=>'community'
          ],
          [
              'title'=>'Traffic Management',
              'group_name'=>'community'
          ],
          [
              'title'=>'Traffic signages available around the construction sites and nearby roads',
              'group_name'=>'community'
          ],
          [
              'title'=>'Re-routing signages sufficient to guide motorists',
              'group_name'=>'community'
          ],
          [
              'title'=>'Excavation sites along roads provided with barricades with reflectors',
              'group_name'=>'community'
          ],
          [
              'title'=>'Excavation sites provided with sufficient lighting at night',
              'group_name'=>'community'
          ],
          [
              'title'=>'Major issues/concerns (specify)',
              'group_name'=>'issues'
          ],
          [
              'title'=>'Corrective Action to be implemented, timeline, responsible person/s, and budget specified',
              'group_name'=>'issues'
          ],
        //   [
        //       'title'=>'Insurance?',
        //       'group_name'=>'socialSafeguard'
        //   ],
        //   [
        //       'title'=>'PPE (gloves/goggles/safety hat/ safety boots, etc..)',
        //       'group_name'=>'socialSafeguard'
        //   ],
        //   [
        //       'title'=>'Safety brefieing to workers by safety officersrecords',
        //       'group_name'=>'socialSafeguard'
        //   ],
        //   [
        //       'title'=>'Mockdrills',
        //       'group_name'=>'socialSafeguard'
        //   ],
        //   [
        //       'title'=>'Training if any:',
        //       'group_name'=>'socialSafeguard'
        //   ],
        //   [
        //       'title'=>'Fire fighting (since Welding is prone in the project)',
        //       'group_name'=>'socialSafeguard'
        //   ],
        //   [
        //       'title'=>'Emergency Assembly management (incase of earthquake or flood or storm etc)',
        //       'group_name'=>'socialSafeguard'
        //   ],

      ];
      DB::table('environmental_monthlies')->insert($rows);
    }
}
