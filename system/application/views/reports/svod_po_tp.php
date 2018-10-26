<?php
function f_d($var)
{
    if (($var == 0) or ($var == NULL)) return "0.00"; else
        return sprintf("%22.2f", $var);
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
<table width=100%>
    <tr>
        <td align=center>
            <b>
                Свод абонентов по ТП
                <?php echo $period->row()->name; ?>
            </b>
        </td>
    </tr>
</table>
<br>
<br>
<table width=100% border=1px>
    <tr>
        <td width=130px>№ Дог.</td>
        <td width=700px>Наименование предприятия</td>
        <td width=700px>Наименование точки учета</td>
        <td width=210px>По учету(кВт/ч)</td>
        <td width=210px>Не учтенный расход(кВт/ч)</td>
        <td width=210px>Итоговый расход(кВт/ч)</td>
    </tr>
    <?php
    $last_tp = -1;
    $sum_1 = 0;
    $sum_2 = 0;
    $sum_3 = 0;

    $_sum_1 = 0;
    $_sum_2 = 0;
    $_sum_3 = 0;

    foreach ($ture->result() as $tp):
        if (($tp->tp_name <> $last_tp) && ($last_tp == -1)) {
            echo "<tr><td width=130px><b>{$tp->tp_name}</b></td><td width=700px></td><td width=700px></td><td widt=210px></td><td width=210px></td><td width=210px></td></tr>";
            $last_tp = $tp->tp_name;
        }
        if ($tp->tp_name <> $last_tp) {
            echo "<tr><td width=130px><b>Итого</b></td><td width=700px><b>по тп №{$last_tp}</b></td><td width=700px></td><td width=210px><b>{$sum_1}</b></td><td width=210px><b>{$sum_2}</b></td><td width=210px><b>{$sum_3}</b></td></tr>";

            echo "<tr><td width=130px><b>{$tp->tp_name}</b></td><td width=700px></td><td width=700px></td><td width=210px></td><td width=210px></td><td width=210px></td></tr>";
            $last_tp = $tp->tp_name;
            $sum_1 = 0;
            $sum_2 = 0;
            $sum_3 = 0;
        }
        $sum_1 += $tp->itogo_uchtennyy_kvt;
        $sum_2 += $tp->itogo_neuchtennyy;
        $sum_3 += $tp->itogo_kvt;
        $_sum_1 += $tp->itogo_uchtennyy_kvt;
        $_sum_2 += $tp->itogo_neuchtennyy;
        $_sum_3 += $tp->itogo_kvt;
        echo
        "<tr>
<td width=130px>{$tp->dogovor}</td>
<td width=700px>{$tp->firm_name}</td>
<td width=700px>{$tp->billing_point_name}</td>
<td width=210px>{$tp->itogo_uchtennyy_kvt}</td>
<td width=210px>{$tp->itogo_neuchtennyy}</td>
<td width=210px>{$tp->itogo_kvt}</td>
</tr>";

    endforeach;
    echo "<tr><td width=130px><b>Итого</b></td><td width=700px><b>по тп №{$last_tp}</b></td><td width=700px></td><td width=210px><b>{$sum_1}</b></td><td width=210px><b>{$sum_2}</b></td><td width=210px><b>{$sum_3}</b></td></tr>";

    echo "<tr><td width=130px><b>Итого</b></td><td width=700px><b></b></td><td width=700px></td><td width=210px><b>{$_sum_1}</b></td><td width=210px><b>{$_sum_2}</b></td><td width=210px><b>{$_sum_3}</b></td></tr>";
    ?>
</table>
</body>
</html>