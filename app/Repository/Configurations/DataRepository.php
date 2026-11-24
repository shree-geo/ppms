<?php

namespace App\Repository\Configurations;
class DataRepository
{

    public function __construct()
    {
    }

    public function casts()
    {
        $result = [
            '1' => 'Brahmin/Chhetry',
            '2' => 'Janajati',
            '3' => 'Dalit',
            '4' => 'Others',
            '5' => 'Muslim'
        ];
        return $result;
    }
    public function samitiPosition()
    {
        $result = [
            '1' => 'Chairperson',
            '2' => 'Vice Chairperson',
            '3' => 'Secretary',
            // '4' => 'Vice Secretary',
            '5' => 'Treasurer',
            '6' => 'Member',
        ]; 
     
        return $result;
    }
    public function englishMonths()
    {
        $result = [
            '1' => 'January',
            '2' => 'February',
            '3' => 'March',
            '4' => 'April',
            '5' => 'May',
            '6' => 'June',
            '7' => 'July',
            '8' => 'August',
            '9' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December',
        ];
        return $result;
    }
    public function grievanceWardDesignation()
    {
        $result = [
            '1' => 'UC Chair',
            '2' => 'PMO Site Office',
            '3' => 'RPMO, Focal Person',
            '4' => 'DSMC Site Engineer',
            '5' => 'Contractor Representative',
            '6' => 'Social Mobilizer',
            '7' => 'Others',
        ];
        return $result;
    }
    public function grievanceMuniDesignation()
    {
        $result = [
            '1' => 'Mayor of municipality',
            '2' => 'Regional Manager/RPMO',
            '3' => 'WUSC secretary',
            '4' => 'RPMO Engineer',
            '5' => 'RPMO Social/Envt Officer',
            '6' => 'DSMC SSS',
            '7' => 'Affected representative',
            '8' => 'CBO representative',
            '9' => 'Contractor representative',
            '10' => 'Others',
        ];
        return $result;
    }
    public function grievanceThirdDesignation()
    {
        $result = [
            '1' => 'Mayor of municipality',
            '2' => 'Regional Manager/RPMO',
            '3' => 'WUSC secretary',
            '4' => 'RPMO Engineer',
            '5' => 'RPMO Social/Envt Officer',
            '6' => 'DSMC SSS',
            '7' => 'Affected representative',
            '8' => 'CBO representative',
            '9' => 'Contractor representative',
        ];
        return $result;
    }
    public function staffDesignation()
    {
        $result = [
            '1' => 'Officer',
            '2' => 'Director',
            '3' => 'Employee',
            '4' => 'Worker',     
        ];
        return $result;
    }

    public function monthDataForReport()
    {
        $result = [
            'jan' => 'January',
            'feb' => 'February',
            'mar' => 'March',
            'apr' => 'April',
            'may' => 'May',
            'june' => 'June',
            'july' => 'July',
            'aug' => 'August',
            'sept' => 'September',
            'oct' => 'October',
            'nov' => 'November',
            'dec' => 'December',
            'quater1' => '1st Quaterly',
            'quater2' => '2nd Quaterly',
            'quater3' => '3rd Quaterly',
            'semi_annual' => 'Semi-Annual',
            'yearly' => 'Yearly',
        ];
        return $result;
    }
}
