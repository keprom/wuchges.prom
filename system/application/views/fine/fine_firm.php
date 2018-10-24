<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Пеня по организации</title>
    <style>
        .border-table, .border-table td, .border-table tr, .border-table th {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .work-day {
            background-color: lightgreen;
        }

        .day-off {
            background-color: #FF0000;
        }

        .bold-color {
            font-weight: bolder;
        }

        @media print {
            .work-day {
                background-color: lightgreen !important;
                -webkit-print-color-adjust: exact;
            }

            .day-off {
                background-color: #FF0000 !important;
                -webkit-print-color-adjust: exact;
            }

            .bold-color {
                font-weight: bolder;
            }
        }
    </style>
</head>
<body>
<h3><?php echo $firm_veds->dogovor . ' ' . $firm_veds->name; ?></h3>
<b>Пеня за <?php echo $period_info->name; ?>. </b>
<?php
$saldo = $firm_veds->saldo_value;
if ($saldo > 0) {
    $dolg_new = $firm_veds->nach;
    $dolg_old = ($saldo - $dolg_new);
    $fine_old = 0;
    $fine_new = 0;
    $day_buf_old = 0;
    $day_count = 0;
    $day_color = 'work-day';
    $border_day_color = '';
    echo "Сальдо на начало текущего месяца: <b>" . prettify_number($saldo) . "</b>";
    echo ". Начислено за прошлый месяц: <b>" . prettify_number($dolg_new) . "</b><br>";
    ?>
    <table class="border-table" border="1px">
        <thead>
        <tr class="head-tr">
            <th colspan="2">День</th>
            <th>Долг на<br>начало месяца, тнг</th>
            <th>Начисление <br>за <?php echo $prev_period_info->name; ?>, тнг</th>
            <th>Ставка<br>реф.(%)</th>
            <th>Коэф.</th>
            <th>Сумма оплаты, тнг</th>
            <th>Пеня по долгу <br>за один день, тнг</th>
            <th>Итого пени <br>по долгу, тнг</th>
            <th>Пеня по начислению <br>за <?php echo $prev_period_info->name; ?> <br>за один день, тнг</th>
            <th>Итого пени по начислению <br>за <?php echo $prev_period_info->name; ?>, тнг</th>
            <th>ИТОГО ВСЕГО ПЕНИ, тнг</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($firm_veds->oplata as $day => $opl) {
            if (array_key_exists($day, $other_ref_rate)) {
                $current_ref_rate = $other_ref_rate[$day];
            }
            if (array_key_exists($day, $other_ref_coef)) {
                $current_ref_coef = $other_ref_coef[$day];
            }
            $k = $current_ref_coef * ($current_ref_rate * 0.01) / 365;
            $day_count = $day - $day_buf_old;

            if ($day == $border_day) {
                $border_day_color = 'bold-color';
            } else {
                $border_day_color = '';
            }
            echo "<tr class='$border_day_color'>";

            echo "<td align='right'>$day</td>";

            if (array_key_exists($day, $month_days)) {

                if ($month_days[$day]['is_off'] == 1) {
                    $day_color = 'day-off';
                }
                echo "<td align='right' class='$day_color'>" . $month_days[$day]['day_shortname'] . "</td>";
            } else {
                echo "<td align='right'></td>";
            }
            $day_color = 'work-day';

            echo "<td class='nowrap' align='right'> " . prettify_number($dolg_old) . "</td>";
            echo "<td class='nowrap' align='right'> " . prettify_number($dolg_new) . "</td>";
            $opl_current = $opl;
            /*отнимаем оплату со старого долга или нового*/
            if (($dolg_old == 0) and ($dolg_new == 0)) {
                $opl = 0;
            }
            if ($dolg_old > 0) {
                $dolg_old = ($dolg_old - $opl);
                $opl = 0;
            }
            if ($dolg_old < 0) {
                $dolg_new += $dolg_old;
                $dolg_old = (int)(0);
            }
            if ($dolg_old == 0) {
                if ($dolg_new > 0) {
                    $dolg_new = ($dolg_new - $opl);
                }
            }
            if ($dolg_new < 0) {
                $dolg_new = (int)(0);
            }
            /*начисляем пеню, если есть на что*/
            if ($dolg_old > 0) {
                $fine_old = $fine_old + ($day - $day_buf_old) * $k * $dolg_old;
            }
            if ($dolg_new > 0) {
                if ($day > $border_day) {
                    $fine_new = $fine_new + ($day - $day_buf_old) * $k * $dolg_new;
                }
            }
            echo "<td align='right'>$current_ref_rate</td>";
            echo "<td align='right'>$current_ref_coef</td>";
            echo "<td class='nowrap' align='right'>" . prettify_number($opl_current) . "</td>";
            if ($dolg_old > 0) {
                echo "<td align='right'>" . prettify_number(($day - $day_buf_old) * $k * $dolg_old) . "</td>";
            } else {
                echo "<td align='right'>" . prettify_number(0) . "</td>";
            }
            echo "<td align='right'>" . prettify_number($fine_old) . "</td>";
            if (($dolg_new > 0) and ($day > $border_day)) {
                echo "<td align='right'>" . prettify_number(($day - $day_buf_old) * $k * $dolg_new) . "</td>";
            } else {
                echo "<td align='right'>" . prettify_number(0) . "</td>";
            }
            echo "<td align='right'>" . prettify_number($fine_new) . "</td>";
            echo "<td align='right'>" . prettify_number($fine_new+$fine_old) . "</td>";
            $day_buf_old = $day;
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <?php
    $fine_total = $fine_old + $fine_new;
    echo "<b>Итого: " . prettify_number($fine_old, 2) . " + " . prettify_number($fine_new, 2) . " = " . prettify_number($fine_total, 2) . " тенге</b></br>";
} else {
    echo "Пени нет";
}
?>


</body>
</html>
