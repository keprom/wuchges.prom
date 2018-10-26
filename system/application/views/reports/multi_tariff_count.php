<?php
function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", $var);
}

function datetostring($date)
{
    $d = explode("-", $date);
    return $d['1'] . '.' . $d['0'] . '.' . $d['2'];
}

?>
<html>
<head>
    <title></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

</head>


<center>Количество многоставочных и одноставочных счетчиков по ТУРЭ <?php echo $ture->name; ?></center>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
    <tr>
        <td>№</td>
        <td>Договор</td>
        <td>Наименование</td>
        <td>Кол-во учетов</td>
        <td>Кол-во выполнено</td>
        <td>Остаток</td>
    </tr>

    <?php $i = 1;
    $sum_multi = 0;
    $sum_single = 0;
    foreach ($firms->result() as $firm):
        $sum_multi += $firm->count_multi_tariff;
        $sum_single += $firm->count_single_tariff;
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $firm->dogovor; ?></td>
            <td><?php echo $firm->firm_name; ?></td>
            <td><?php echo $firm->count_single_tariff + $firm->count_multi_tariff; ?></td>
            <td><?php echo $firm->count_multi_tariff; ?></td>
            <td><?php echo $firm->count_single_tariff ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan=3>ИТОГО</td>
        <td><?php echo $sum_multi + $sum_single; ?></td>
        <td><?php echo $sum_multi; ?></td>
        <td><?php echo $sum_single ?></td>
    </tr>
</table>

</html>