<?php
function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", $var);
}
function f_d2($var)
{
    return sprintf("%22.2f", $var);
}
function datetostring($date)
{
    $d = explode("-", $date);
    return $d['2'] . '.' . $d['1'];
}
?>

<?php echo anchor(base_url()."/billing/fine/".$firm_info->id,"Назад к фирме" )."<br>";?>
<h3><?php echo $firm_info->dogovor . ' - ' . $firm_info->name; ?></h3>
<b>Оплата за <?php echo mb_strtolower($period_info->name, 'utf-8'); ?>:</b><br><br>

<table border=1px width=100% style="border: black;" cellspacing=0px cellpadding=0px>
    <tr>
        <td><b>Оплата с ндс</b></td>
        <td><b>Ндс</b></td>
        <td><b>Номер счета</b></td>
        <td><b>Расшифровка счета</b></td>
        <td width=100px><b>Дата</b></td>
    </tr>
    <?php
    $sum = 0;
    $sum_nds = 0;

    foreach ($fine_firm_oplata as $o):
        $sum += $o->value * ($o->nds + 100) / 100;
        $sum_nds += $o->value * $o->nds / 100;
        echo "<tr><td>" . f_d($o->value * ($o->nds + 100) / 100) . "</td><td>" . f_d($o->value * $o->nds / 100) . "</td><td>"
            . $o->number .
            "</td><td>"
            . $o->name .
            "</td><td>"
            . datetostring($o->data) .
            "</td></tr>";
    endforeach;

    ?>
    <tr>
        <td><b>Итого</b></td>
        <td>.</td>
        <td>.</td>
        <td>.</td>
        <td>.</td>
    </tr>
    <tr>
        <td><?php echo f_d2($sum) ?></td>
        <td><?php echo f_d2($sum_nds); ?></td>
        <td>.</td>
        <td>.</td>
        <td>.</td>
    </tr>
</table>