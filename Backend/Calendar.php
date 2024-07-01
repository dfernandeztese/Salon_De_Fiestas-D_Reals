<?php

class Calendar {
    private $month;
    private $year;
    private $days_of_week;
    private $num_days;
    private $date_info;
    private $day_of_week;

    public function __construct($month, $year) {
        $this->month = $month;
        $this->year = $year;
        $this->days_of_week = array('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb');
        $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->date_info = getdate(mktime(0, 0, 0, $this->month, 1, $this->year));
        $this->day_of_week = $this->date_info['wday'];
    }

    public function show($occupied_days = []) {
        $html = '<table class="calendar">';
        $html .= '<tr>';

        foreach ($this->days_of_week as $day) {
            $html .= '<th class="header">' . $day . '</th>';
        }

        $html .= '</tr><tr>';

        if ($this->day_of_week > 0) {
            $html .= '<td colspan="' . $this->day_of_week . '"></td>';
        }

        $current_day = 1;

        while ($current_day <= $this->num_days) {
            if ($this->day_of_week == 7) {
                $this->day_of_week = 0;
                $html .= '</tr><tr>';
            }

            $current_date = $this->year . '-' . str_pad($this->month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($current_day, 2, '0', STR_PAD_LEFT);
            $class = in_array($current_date, $occupied_days) ? 'occupied' : '';

            $html .= '<td class="day ' . $class . '">' . $current_day . '</td>';

            $current_day++;
            $this->day_of_week++;
        }

        if ($this->day_of_week != 7) {
            $remaining_days = 7 - $this->day_of_week;
            $html .= '<td colspan="' . $remaining_days . '"></td>';
        }

        $html .= '</tr>';
        $html .= '</table>';

        return $html;
    }
}

?>