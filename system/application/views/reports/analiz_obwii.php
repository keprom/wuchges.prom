<?php
function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else {
        if ($var == null) return "&nbsp;"; else
            return sprintf("%22.2f", $var);
    }
}

function datetostring($date)
{
    $d = explode("-", $date);
    return $d['0'] . '.' . $d['1'] . '.' . $d['2'];
}

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>

<center>
    <b>Анализ<br> учета полученной товарной продукции ( электроэнергии )<br> по
        <?php echo $org->org_name; ?> <br> с применением общего тарифа за
        <?php echo $period->name; ?></b>
</center>
<br>
<br>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
    <tr align=center>
        <td rowspan=3>№
        </td>
        <td rowspan=3>Наименование потребителя
        </td>
        <td colspan=2>Получено товарной продукции
        </td>
        <td rowspan=3 width=80px>Всего кВт/ч
        </td>
        <td rowspan=3 width=100px>Всего тенге (без НДС)
        </td>

    </tr>
    <tr>
        <td colspan=2>
            По тарифу общий
        </td>

    </tr>
    <tr>
        <td>
            кВт/ч
        </td>
        <td>
            тенге
        </td>


    </tr>
    <?php
    $sum_day_kvt = 0;
    $sum_day_tenge = 0;

    $sum_bez_nds = 0;

    $vsego_kvt = 0;


    $j = 1;
    foreach ($diff->result() as $d):

        $sum_day_kvt += $d->itogo_kvt_day;
        $sum_day_tenge += $d->tenge_day;

        $buf_sum_with_nds = 0;
        $buf_sum_otp_nds = 0;
        $buf_vsego_kvt = 0;

        $sum_bez_nds += ($d->tenge_day);
        $vsego_kvt += ($d->itogo_kvt_day);

        ?>
        <tr>
            <td>
                <?php echo $j++; ?>
            </td>
            <td>
                <?php echo $d->firm_subgroup_name; ?>
            </td>
            <td>
                <?php echo f_d($d->itogo_kvt_day); ?>
            </td>
            <td>
                <?php echo f_d($d->tenge_day); ?>
            </td>


            <td>
                <?php echo f_d($buf_vsego_kvt); ?>
            </td>
            <td>
                <?php echo f_d($d->tenge_day); ?>
            </td>


        </tr>
    <?php endforeach; ?>
    <tr>
        <td>&nbsp;
        </td>
        <th align=right>
            <b>Итого</b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_day_kvt); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_day_tenge); ?></b>
        </th>

        <th align=right>
            <b><?php echo f_d($sum_day_kvt); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_day_tenge); ?></b>
        </th>


    </tr>
</table>
<br>
<table width=100% style="border: black;font-family: Verdana; font-size:  small;">

</body>
</html>