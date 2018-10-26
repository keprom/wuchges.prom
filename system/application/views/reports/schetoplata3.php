<?php
function datetostring($date)
{
    $d = explode("-", $date);
    return $d['2'] . '.' . $d['1'] . '.' . $d['0'];
}

function f_d($var)
{
    if ($var == 0) return "&nbsp;"; else
        return sprintf("%22.2f", $var);
}

?>
<html>
<head>
    <title>Счет на оплату</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<br>
<center>
    <table width=700px>
        <tr>
            <td>
                Филиал ТОО "Кокшетау Энерго Центр" Восток Энерго<br/>
                РНН <?php echo $org->rnn; ?> <br/>
                ИИК <?php echo $org->IIK; ?> <br/>
                БИК <?php echo $org->bank_bik; ?> <br/>
                БИН <?php echo $org->bin; ?> <br/>
                <?php echo $org->svidetelstvo_nds; ?> <br/>
                Адрес: 021700 Акмолинская область, Бурабайский раойон, г. Щучинск <br/> <br/>

            </td>
        </tr>
    </table>
    <br>
    <br>
    <b>
        Накладная<br/> на отпуск эл. энергии</br> согластно отчета потребителей<br/>
        №________________ от __________ 20__ г
    </b>
</center>
<br/>
От кого&nbsp;&nbsp;&nbsp; <u>Филиал ТОО "Кокшетау Энерго Центр" Восток Энерго</u><br/><br/>
Кому &nbsp;&nbsp;&nbsp;<u><?php echo $firm->name; ?></u>
<br>
<br>
<br>
<table cellSpacing=0 border=1>
    <TR>
        <TD vAlign=center align=middle rowSpan=2><FONT size=2>№ п/п</FONT>
        <TD vAlign=center align=middle rowSpan=2><FONT size=2>Наименование товаров
                (работ, услуг)</FONT>
        <TD vAlign=center align=middle rowSpan=2><FONT size=2>Ед. изм.</FONT>
        <TD vAlign=center align=middle rowSpan=2><FONT size=2>Кол-во
                (объем)</FONT>
        <TD vAlign=center align=middle rowSpan=2><FONT size=2>Цена тенге</FONT>
        <TD vAlign=center align=middle rowSpan=2><FONT size=2>Стоимость товаров
                (работ, услуг) без НДС</FONT>
        <TD vAlign=center align=middle colSpan=2><FONT size=2>НДС</FONT>
        <TD vAlign=center align=middle rowSpan=2><FONT size=2>Всего стоимость
                реализации</FONT>
        <TD vAlign=center align=middle colSpan=2><FONT size=2>Акциз</FONT></TD>
    <TR>
        <TD vAlign=center align=middle><FONT size=2>Ставка</FONT>
        <TD vAlign=center align=middle><FONT size=2>Сумма</FONT>
        <TD vAlign=center align=middle><FONT size=2>Ставка</FONT>
        <TD vAlign=center align=middle><FONT size=2>Сумма</FONT></TD>
    <TR>
        <TD vAlign=center align=middle><FONT size=1><I>1</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>2</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>3</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>4</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>5</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>6</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>7</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>8</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>9</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>10</I></FONT>
        <TD vAlign=center align=middle><FONT size=1><I>11</I></FONT></TD>
        <?php $sum_bez_nds = 0;
        $sum_nds = 0;
        $sum = 0;
        $i = 1;
        for ($j = 0;
        $j < $tariff_count;
        $j++):
        if ($tariff_kvt[$j] == 0) continue; ?>

    <TR>
        <TD vAlign=center align=middle><FONT size=1><?php echo $i++; ?> </FONT>
        <TD vAlign=center align=middle><FONT size=1>Электроэнергия за период<br>
                с <?php echo $data_start . " по " . $data_finish . "   "; ?></FONT>
        <TD vAlign=center align=middle><FONT size=1>кВ</FONT>
        <TD vAlign=center align=middle><FONT size=1> <?php echo f_d($tariff_kvt[$j]); ?> </FONT>
        <TD vAlign=center align=middle><FONT size=1> <?php echo f_d($tariff_value[$j]); ?> </FONT>
        <TD vAlign=center align=middle><FONT size=1> <?php echo f_d($tariff_kvt[$j] * $tariff_value[$j]);
                $sum_bez_nds += $tariff_kvt[$j] * $tariff_value[$j]; ?> </FONT>
        <TD vAlign=center align=middle><FONT size=1> <?php echo f_d($period->nds); ?> </FONT>
        <TD vAlign=center align=middle><FONT
                    size=1> <?php echo f_d($period->nds * $tariff_kvt[$j] * $tariff_value[$j] / 100);
                $sum_nds += $period->nds * $tariff_kvt[$j] * $tariff_value[$j] / 100; ?> </FONT>
        <TD vAlign=center align=middle><FONT
                    size=1> <?php echo f_d(($period->nds + 100) * $tariff_kvt[$j] * $tariff_value[$j] / 100);
                $sum += ($period->nds + 100) * $tariff_kvt[$j] * $tariff_value[$j] / 100; ?> </FONT>
        <TD vAlign=center align=middle><FONT size=1>0</FONT>
        <TD vAlign=center align=middle><FONT size=1>0</FONT></TD>
        <?php endfor; ?>
    <TR>
        <TD align=left colSpan=5><FONT size=2><B>Всего по счету:</B></FONT>
        <TD align=right><FONT size=2><B>&nbsp;<?php echo f_d($sum_bez_nds); ?></B></FONT>
        <TD align=right bgColor=#c0c0c0><FONT size=2>&nbsp;</FONT>
        <TD align=right><FONT size=2><B>&nbsp;<?php echo f_d($sum_nds); ?></B></FONT>
        <TD align=right><FONT size=2><B>&nbsp;<?php echo f_d($sum); ?></B></FONT>
        <TD align=right bgColor=#c0c0c0><FONT size=2>&nbsp;</FONT>
        <TD align=right><FONT size=2><B>&nbsp;</B></FONT></TD>

</table>
<br/>
<br/>
<br/>
&nbsp;&nbsp;&nbsp;<table width=100%>
    <tr>
        <td width=30px>&nbsp;</td>
        <td align=left>Разрешил:</td>
        <td align=right></td>
    </tr>
    <tr>
        <td></td>
        <td align=left>&nbsp;</td>
        <td align=right>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td align=left>Зам. директора</td>
        <td align=left> <?php echo $org->zam_directora_po_sbytu; ?></td>
    </tr>
    <tr>
        <td></td>
        <td align=left>&nbsp;</td>
        <td align=right>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td align=left>Гл. бухгалтер</td>
        <td align=left> <?php echo $org->glav_buh; ?></td>
    </tr>
    <tr>
        <td></td>
        <td align=left>&nbsp;</td>
        <td align=right>&nbsp;</td>
    </tr>
    <tr>
        <td></td>
        <td align=left>Получил</td>
        <td align=right></td>
    </tr>

</table>
</body>
</html>