<?php
function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", $var);
} ?>
<html>
<head>
    <title>Журнал счет-фактур</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>

<center><b>ЖУРНАЛ СЧЕТ-ФАКТУР<br/><?php echo " за " . $period_name->current_period; ?></b></center>
<table border=1px width=100%>

    <tr>
        <td align=left>
            <b>Договор</b>
        </td>
        <td align=left>
            <b>Наименование</b>
        </td>
        <td align=center>
            <b>Начисление</b>
        </td>
        <td align=right>
            <b>№ счета-фактуры</b>
        </td>
        <td align=right>
            <b>Дата</b>
        </td>
        <td align=right>
            <b>Дата выдачи</b>
        </td>
    </tr>


    <?php
    foreach ($jurnal->result() as $j):?>
        <tr>
            <td><?php echo $j->dogovor; ?> </td>
            <td><?php echo $j->firm_name; ?> </td>
            <td align=right><?php echo f_d($j->nachisleno); ?> </td>
            <td align=right><?php echo $j->schetfactura_date_id; ?> </td>
            <td align=right><?php echo $j->date; ?> </td>
            <td align=right><?php echo $j->data_vydachi; ?> </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
