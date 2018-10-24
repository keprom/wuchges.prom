<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Календарь</title>
    <style>
        .border-table td, .border-table tr, .border-table th {
            border: 1px solid white;
            border-collapse: collapse;
        }

        .border-table {
            border: 1px solid black;
        }

        .work-day {
            background-color: lightgreen;
        }

        .day-off {
            background-color: #FF0000;
        }

        .border-table td {
            padding: 2px 10px 2px 10px;
            font-size: 130%;
        }

        .empty-day {
            background-color: aliceblue;
        }

        .link-day, .link-day:link {
            color: #000000;
            text-decoration: none;
        }

        .work-day:hover {
            background-color: #008800;
        }

        .day-off:hover {
            background-color: hotpink;
        }

        .month-list {
            list-style: none;
            display: inline-block;
        }

        /* Tooltip container */
        .tooltip {
            position: relative;
            display: inline-block;
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text */
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;

            /* Fade in tooltip */
            opacity: 0;
            transition: opacity 0.3s;
        }

        /* Tooltip arrow */
        .tooltip .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

    </style>
</head>
<body>

<h1 align="center">Календарь <?php echo $calendar[0]->year; ?> года</h1>

<?php
$day_color = 'work-day';
$prev_month = -1;
$prev_day = -1;
$prev_week = -1;
$first_day = true;
$count_wd = 0;
?>
<ul>
    <?php for ($i = 0; $i < count($calendar); $i++) { ?>


        <?php if ($prev_month != $calendar[$i]->month): ?>

            <li class="month-list">

            <table class="border-table">
            <caption><b><?php echo $calendar[$i]->month_name . ' ' . $calendar[$i]->year; ?></b></caption>
            <thead>
            <tr>
                <th>Пн</th>
                <th>Вт</th>
                <th>Ср</th>
                <th>Чт</th>
                <th>Пт</th>
                <th>Сб</th>
                <th>Вс</th>
            </tr>
            </thead>
            <tbody>
        <?php endif; ?>
        <?php if ($prev_week != $calendar[$i]->week_of_year) {
            $prev_week = $calendar[$i]->week_of_year;
            echo "<tr class='open-week'>";
            for ($j = 1; $j < $calendar[$i]->day_of_week; $j++) {
                echo "<td class='empty-day'></td>";
            }
        } ?>
        <?php if ($calendar[$i]->is_off == 1) {
            $day_color = 'day-off';
        } else {
            $count_wd++;
        } ?>
        <td align="right" class="<?php echo $day_color; ?>">
            <div class="tooltip">
                <a class="link-day"
                   href="<?php echo site_url('billing/change_calendar_day/' . $calendar[$i]->day_id) ?>"><?php echo $calendar[$i]->day; ?></a>
                <span class="tooltiptext"><?php echo 'Рабочих дней: ' . $count_wd; ?></span>
            </div>

        </td>
        <?php $day_color = 'work-day'; ?>
        <?php if (
            (
                (isset($calendar[$i + 1]))
                AND
                (($calendar[$i + 1]->month != $calendar[$i]->month) and ($calendar[$i + 1]->week_of_year == $calendar[$i]->week_of_year))
            )
            OR (!isset($calendar[$i + 1]))
            OR
            (
                (isset($calendar[$i + 1]))
                AND
                ($calendar[$i + 1]->week_of_year != $calendar[$i]->week_of_year)
            )
        ) {
            $prev_week = -1;
            for ($j = $calendar[$i]->day_of_week; $j < 7; $j++) {
                echo "<td class='empty-day'></td>";
            }
            echo "</tr class='close-week'>";
        } ?>
        <?php if (((isset($calendar[$i + 1])) and ($calendar[$i + 1]->month != $calendar[$i]->month)) OR (!isset($calendar[$i + 1]))): ?>
            </tbody>
            </table>

            </li>

            <?php
            $prev_week = -1;
            $count_wd = 0;
            ?>
        <?php endif; ?>
        <?php
        $prev_month = $calendar[$i]->month;
        ?>


    <?php }; ?>
</ul>

</body>
</html>
