<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('get_month_title')) {
    function get_month_title($date)
    {
        $d = explode("-", $date);

        $months = array(
            1 => 'январь',
            2 => 'февраль',
            3 => 'март',
            4 => 'апрель',
            5 => 'май',
            6 => 'июнь',
            7 => 'июль',
            8 => 'август',
            9 => 'сентябрь',
            10 => 'октябрь',
            11 => 'ноябрь',
            12 => 'декабрь'
        );

        return $months[(int)$d[1]];
    }
}

if (!function_exists('get_year_number')) {
    function get_year_number($date)
    {
        $d = explode("-", $date);
        return $d[0];
    }
}

if (!function_exists('get_month_number')) {
    function get_month_number($date)
    {
        $d = explode("-", $date);
        return $d[1];
    }
}

if (!function_exists('get_day_number')) {
    function get_day_number($date)
    {
        $d = explode("-", $date);
        return (int)$d[2];
    }
}

if (!function_exists('format_number')) {
    function format_number($format, $var, $returns_if_null = '', $digits_to_round = NULL)
    {
        if ($var == NULL) return $returns_if_null;
        if ($digits_to_round == NULL or $digits_to_round < 1) {
            $formatted_num = sprintf($format, $var);
        } else {
            $point_digit = 1;
            for ($i = 0; $i < $digits_to_round; $i++) {
                $point_digit = $point_digit * 10;
            }
            $formatted_num = sprintf($format, round($var * $point_digit) / $point_digit);
        }
        return $formatted_num;
    }
}

if (!function_exists('days_diff')) {
    function days_diff($start_date, $end_date)
    {
        $start_d = explode('-', $start_date);
        $end_d = explode('-', $end_date);
        if ($start_d[0] >= $end_d[0]) {
            if (($start_d[0] > $end_d[0]) or ($start_d[1] > $end_d[1]) or ($start_d[2] > $end_d[2])) {
                return -1;
            }
        }
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $difference = round(($end->format('U') - $start->format('U')) / (60 * 60 * 24));
        return $difference;
    }
}


if (!function_exists('prettify_number')) {
    function prettify_number($number, $decimals = 2)
    {
        return number_format($number, $decimals, ',', ' ');
    }
}

?>