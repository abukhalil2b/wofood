<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{

    public function run(): void
    {
        $todayDate = date('Y-m-d');

        $active = 0;

        foreach ($this->date_range($todayDate, "2023-08-25", "+1 day", "Y-m-d") as $enDate) {

            $dayName = $this->getDayName(date('w', strtotime($enDate)));

            if ($enDate >= '2023-08-18') {
                $active = 1;
            }

            Day::create([
                'en_date' => $enDate,
                'title' => $dayName,
                'ar_date' => $enDate,
                'active' => $active,
            ]);
        }
    }

    /**
     * Creating date collection between two dates
     *
     * <code>
     * <?php
     * # Example 1
     * date_range("2014-01-01", "2014-01-20", "+1 day", "m/d/Y");
     *
     * # Example 2. you can use even time
     * date_range("01:00:00", "23:00:00", "+1 hour", "H:i:s");
     * </code>
     *
     * @author Ali OYGUR <alioygur@gmail.com>
     * @param string since any date, time or datetime format
     * @param string until any date, time or datetime format
     * @param string step
     * @param string date of output format
     * @return array
     */
    function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
    {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }

    function getDayName($dayOfWeek)
    {

        switch ($dayOfWeek) {
            case 6:
                return 'السبت';
            case 0:
                return 'الأحد';
            case 1:
                return 'الإثنين';
            case 2:
                return 'الثلاثاء';
            case 3:
                return 'الأربعاء';
            case 4:
                return 'الخميس';
            case 5:
                return 'الجمعة';
            default:
                return '';
        }
    }
}
