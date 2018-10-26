<?php
function datetostring($date)
{
    $d = explode("-", $date);
    return $d['2'] . '.' . $d['1'] . '.' . $d['0'];
}

function f_d($var)
{
    if (($var == 0) or ($var == NULL)) return "0.00"; else
        return sprintf("%22.2f", $var);
}

function f_d3($var)
{
    if (($var == 0) or ($var == NULL)) return "0.000"; else
        return sprintf("%22.3f", $var);
}

?>
<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <title>Накладная</title>
    <style>
    </style>
</head>
<body lang=RU>
<table width=1050px>
    <tr>
        <td>
            <?php print "РНН " . $org->rnn; ?><br>
            <?php print "ИИК " . $org->rnn . " в " . $org->bank_name; ?><br>
            <?php print "БИК " . $org->bank_bik; ?><br>
            <?php print "БИН " . $org->bin; ?><br>
            <?php print $org->svidetelstvo_nds; ?><br>
            <?php print $org->org_name; ?><br>
            <?php print "Адрес: " . $org->address; ?><br>
            <center>
                <b>
                    Накладаная<br>
                    на отпуск эл. энергии<br>
                    согласно отчета потребителей</b><br>
                <?php print "№ " . $schetfactura_date->id . " от ";
                if (strlen($data_schet) == 0) {
                    print datetostring($schetfactura_date->date);
                } else {
                    print $data_schet;
                }
                ?>
            </center>
            <br><br><br>
            <?php print "От кого " . $org->org_name; ?><br>
            <?php print "Кому " . $firm->name; ?><br>
            <br><br>
            <table width=900px>
                <tr>
                    <td width=20px>
                        <b>№ п/п</b>
                    </td>
                    <td width=350px>
                        <b>Наименование материалов</b>
                    </td>
                    <td width=90px>
                        <b>ед изм</b>
                    </td>
                    <td width=200px>
                        <b>кол-во</b>
                    </td>
                    <td width=50px>
                        <b>цена без НДС</b>
                    </td>
                    <td width=200px>
                        <b>сумма</b>
                    </td>
                </tr>


            </table>
            <br><br>
            <table width=800px>
                <tr>
                    <td width=500px>
                        Разрешил директор
                    </td>
                    <td width=300px>
                    </td>
                </tr>
                <tr>
                    <td width=500px>
                        Гл. бухгалтер
                    </td>
                    <td width=300px>
                    </td>
                </tr>
                <tr>
                    <td width=500px>
                        Отпустил инженер ос
                    </td>
                    <td width=300px>
                    </td>
                </tr>
                <tr>
                    <td width=500px>
                        Получил
                    </td>
                    <td width=300px>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html> 