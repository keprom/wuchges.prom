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
    <b>Ведомость<br> учета полученной товарной продукции ( электроэнергии )<br> по филиалу
        ТОО "Кокше Энерго Центр" Горэлектросети <br> за
        <?php echo $period->name; ?></b>
</center>
<br>
<br>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
    <tr>
        <td rowspan=3>№
        </td>
        <td rowspan=3>Наименование потребителя
        </td>
        <td colspan=8>Получено товарной продукции
        </td>
        <td rowspan=3>Начислено НДС тенге
        </td>
        <td rowspan=3>Всего с НДС тенге
        </td>
    </tr>
    <tr>
        <td colspan=2>
            По тарифу дневной
        </td>
        <td colspan=2>
            По тарифу ночной
        </td>
        <td colspan=2>
            По тарифу вечерний
        </td>

        <td colspan=2>
            Итого
        </td>
    </tr>
    <tr>
        <td>
            кВт/ч
        </td>
        <td>
            тенге
        </td>
        <td>
            кВт/ч
        </td>
        <td>
            тенге
        </td>
        <td>
            кВт/ч
        </td>
        <td>
            тенге
        </td>
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
    $sum_night_kvt = 0;
    $sum_night_tenge = 0;
    $sum_evening_kvt = 0;
    $sum_evening_tenge = 0;
    $sum_nds = 0;
    $sum_with_nds = 0;

    $j = 1;
    foreach ($diff->result() as $d):

        $sum_day_kvt += $d->itogo_kvt_day;
        $sum_day_tenge += $d->tenge_day;
        $sum_night_kvt += $d->itogo_kvt_night;
        $sum_night_tenge += $d->tenge_night;
        $sum_evening_kvt += $d->itogo_kvt_evening;
        $sum_evening_tenge += $d->tenge_evening;

        $sum_nds += ($d->tenge_night + $d->tenge_day + $d->tenge_evening) * $d->nds / 100;
        $sum_with_nds += ($d->tenge_night + $d->tenge_day + $d->tenge_evening) * ($d->nds + 100) / 100;
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
                <?php echo f_d($d->itogo_kvt_night); ?>
            </td>
            <td>
                <?php echo f_d($d->tenge_night); ?>
            </td>
            <td>
                <?php echo f_d($d->itogo_kvt_evening); ?>
            </td>
            <td>
                <?php echo f_d($d->tenge_evening); ?>
            </td>

            <td>
                <?php echo f_d($d->itogo_kvt_night + $d->itogo_kvt_day + $d->itogo_kvt_evening); ?>
            </td>
            <td>
                <?php echo f_d($d->tenge_night + $d->tenge_day + $d->tenge_evening); ?>
            </td>
            <td>
                <?php echo f_d(($d->tenge_night + $d->tenge_day + $d->tenge_evening) * $d->nds / 100); ?>
            </td>
            <td>
                <?php echo f_d(($d->tenge_night + $d->tenge_day + $d->tenge_evening) * ($d->nds + 100) / 100); ?>
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
            <b><?php echo f_d($sum_night_kvt); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_night_tenge); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_evening_kvt); ?></b>
        </th>

        <th align=right>
            <b><?php echo f_d($sum_evening_tenge); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_night_kvt + $sum_day_kvt + $sum_evening_kvt); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_night_tenge + $sum_day_tenge + $sum_evening_tenge); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_nds); ?></b>
        </th>
        <th align=right>
            <b><?php echo f_d($sum_with_nds); ?></b>
        </th>

    </tr>
</table>
</body>
</html>