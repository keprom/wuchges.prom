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
    <link rel="stylesheet" href="/css/fullpage.css">
</head>
<center>Информация по неначисленным предприятиям за <?php echo $period->name . " "; ?> </center>
<br>
<table width=100% border=1px cellspacing=0px style="border: black;">
    <thead>
    <tr>
        <th>№</th>
        <th>Договор</th>
        <th>Наименование</th>
        <?php
        switch ($debt_type_id):
            case -1:
                echo "<th>Дебет</th>";
                echo "<th>Кредит</th>";
                break;
            case 0:
                echo "<th>Дебет</th>";
                break;
            case 1:
                echo "<th>Кредит</th>";
                break;
            default:
                break;
        endswitch;
        ?>
        <th colspan="2">Последнее начисление</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;
    foreach ($firms->result() as $firm): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $firm->dogovor; ?></td>
            <td><?php echo $firm->firm_name; ?></td>
            <?php
            $debet_value = $firm->debet_value == 0 ? '':prettify_number($firm->debet_value);
            $kredit_value = $firm->kredit_value == 0 ? '':prettify_number($firm->kredit_value);
            $itogo_with_nds = $firm->itogo_with_nds == 0 ? '':prettify_number($firm->itogo_with_nds);
            switch ($debt_type_id) :
                case -1:
                    echo "<td class='td-number'>{$debet_value}</td>";
                    echo "<td class='td-number'>{$kredit_value}</td>";
                    break;
                case 0:
                    echo "<td class='td-number'>{$debet_value}</td>";
                    break;
                case 1:
                    echo "<td class='td-number'>{$kredit_value}</td>";
                    break;
                default:
                    break;
            endswitch;
            ?>
            <td class="td-number"><?php echo $firm->period_name; ?></td>
            <td class="td-number"><?php echo prettify_number($itogo_with_nds); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</html>