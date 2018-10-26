<?php
function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", $var);
}

?>
<html>
<head>
    <title>Отчет по оплате за электроэнергию</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <?php
    function dt($date)
    {
        $d = explode("-", $date);
        echo $d['2'] . '.' . $d['1'] . '.' . $d['0'];
    }

    ;
    function f($date)
    {
        $d = explode(".", "$date");
        echo $d['0'] . ',' . $d['1'];
    }

    ;
    ?>
</head>
<body>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">

    <?php $i = 1;
    foreach ($firms->result() as $firm): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $firm->rnn; ?></td>
            <td>&nbsp;</td>
            <td><?php echo $firm->dogovor; ?></td>

            <td><?php echo dt($firm->begin_date); ?></td>
            <td><?php echo f($firm->itog_tenge); ?></td>
            <td><?php echo f($firm->itogo_nds); ?></td>
            <td><?php echo f($firm->itogo_with_nds); ?></td>

        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>