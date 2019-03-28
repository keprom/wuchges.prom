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
    <title>Не начислено</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<center>Информация по неначисленным предприятиям за <?php echo $period->name . " "; ?> </center>
<br>
<table width=100% border=1px cellspacing=0px style="border: black;">
    <tr>
        <td>№</td>
        <td>Договор</td>
        <td>Наименование</td>
        <td>Дебет</td>
        <td>Кредит</td>
    </tr>
    <?php $i = 1;
    foreach ($firms->result() as $firm): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $firm->dogovor; ?></td>
            <td><?php echo $firm->firm_name; ?></td>
            <td><?php echo prettify_number($firm->debet_value); ?></td>
            <td><?php echo prettify_number($firm->kredit_value); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</html>