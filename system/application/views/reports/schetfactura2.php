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

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>
<table width=100%>
    <tr align=center>
        <td width=2100px>
            <b>СЧЕТ-ФАКТУРА №</b> <?php echo $schetfactura_date->id . ' от ';
            if (strlen($data_schet) == 0) {
                echo datetostring($schetfactura_date->date);
            } else {
                echo $data_schet;
            } ?>
        </td>
        <td align=left> (1)</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td width=2100px>
            <b>Поставщик</b> <u><?php echo $org->org_name; ?></u>

        </td>
        <td> (2)</td>
    </tr>
    <tr>
        <td width=2100px>
            РНН и адрес местонахождения поставщика <?php echo $org->rnn . "  Адрес: <u>" . $org->address; ?></u>
        </td>
        <td> (3)</td>
    </tr>
    <tr>
        <td width=2100px>  <?php echo $org->svidetelstvo_nds; ?> </td>
        <td> (4)</td>
    </tr>
    <tr>
        <td width=2100px> ИИК поставщика № <u><?php echo $org->IIK; ?></u>
            КБЕ-<?php echo $org->Bank_kbe; ?> КНП-<?php echo $org->bank_knp; ?> </td>
        <td> (5)</td>
    </tr>
    <tr>
        <td align=left><u><?php echo $org->bank_name; ?></u>
            БИК <?php echo $org->bank_bik; ?> БИН <?php echo $org->bin; ?> </td>
        <td></td>
    </tr>
    <tr>
        <td width=2100px> Договор(контракт) на поставку товаров (работ, услуг)
            № <?php echo $firm->dogovor . " от " . datetostring($firm->dogovor_date); ?></td>
        <td> (3)</td>
    </tr>
    <tr>
        <td width=2100px> Условия оплаты по договору (контракту)<u><?php echo $edit1; ?></u>________________</td>
        <td> (3а)</td>
    </tr>
    <tr>
        <td width=2100px> Пункт назначения поставляемых товаров (работ, услуг)<u><?php echo $edit2; ?></u>_________________________
        </td>
        <td> (4)</td>
    </tr>
    <tr align=right>
        <td width=2100px>(государство, регион, область, город, район)</td>
        <td></td>
    </tr>
    <tr>
        <td width=2100px> Поставка товаров осуществлена по доверенности №<u><?php echo $edit3; ?></u>__________________________
        </td>
        <td> (5)</td>
    </tr>
    <tr>
        <td width=2100px> Способ отправления <u><?php echo $edit4; ?></u>________________________________________________________
        </td>
        <td> (6)</td>
    </tr>
    <tr>
        <td width=2100px> Грузоотправитель <u><?php echo $edit5; ?></u>__________________________________________________________
        </td>
        <td> (7)</td>
    </tr>
    <tr>
        <td width=2100px> Грузополучатель <u><?php echo $edit6; ?></u>___________________________________________________________
        </td>
        <td> (8)</td>
    </tr>
    <tr>
        <td width=2100px><b> Покупатель </b><u><?php echo $firm->name ?></u></td>
        <td> (8а)</td>
    </tr>
    <tr>
        <td width=2100px> РНН и адрес местонахождения покупателя <u><?php echo $firm->rnn; ?></u>
            <u><?php echo $firm->address; ?></u></td>
        <td> (8б)</td>
    </tr>
    <tr>
        <td width=2100px>
            ИИК <?php echo $firm->raschetnyy_schet; ?>   <?php echo $bank->name . "  БИК " . $bank->mfo; ?></td>
        <td> (8в)</td>
    </tr>
</table>
<br>

<table width=100% border=1px cellspacing=0px style="border: black;font-family: Verdana; font-size: x-small;">
    <tr>
        <td rowspan="2" width="60px">№<br/>П/п</td>
        <td rowspan="2" width="400px">Наименование товаров<br/> (работ, услуг)</td>
        <td rowspan="2" width="100px">Ед.<br/>изм.</td>
        <td rowspan="2" width="200px">Кол-во<br/>(обьем)</td>
        <td rowspan="2" width="100px">Цена<br/>тенге</td>
        <td rowspan="2" width="300px">Стоимость товаров<br/>(работ, услуг) без НДС</td>
        <td colspan="2" width="360px">НДС</td>
        <td rowspan="2" width="400px">Всего<br/>стоимость<br/>реализации</td>
        <td colspan="2" width="210px">Акциз</td>
    </tr>
    <tr>
        <td width="110px">Ставка</td>
        <td width="250px">Сумма</td>
        <td width="110px">Ставка</td>
        <td width="100px">Сумма</td>
    </tr>
    <tr align="center">
        <td width="60px">1</td>
        <td width="400px">2</td>
        <td width="100px">3</td>
        <td width="200px">4</td>
        <td width="100px">5</td>
        <td width="300px">6</td>
        <td width="110px">7</td>
        <td width="250px">8</td>
        <td width="400px">9</td>
        <td width="110px">10</td>
        <td width="100px">11</td>
    </tr>
    <?php $sum_bez_nds = 0;
    $sum_nds = 0;
    $sum = 0;
    $i = 1;
    foreach ($s as $s2): ?>
        <tr align="center">
            <TD width="60px"><?php echo $i++; ?></td>
            <TD width="400px">Электроэнергия</td>
            <TD width="100px">кВт</td>
            <TD width="200px"><?php echo $s2->kvt; ?></td>
            <TD width="100px"><?php echo f_d($s2->tariff_value); ?></td>
            <TD width="300px" align="right"><?php echo $s2->tenge;
                $sum_bez_nds += $s2->tenge; ?></td>
            <TD width="110px"><?php echo $s2->nds; ?></td>
            <TD width="250px" align="right"><?php echo $s2->nds_value;
                $sum_nds += $s2->nds_value; ?></td>
            <TD width="400px" align="right"><?php echo $s2->with_nds;
                $sum += $s2->with_nds; ?></td>
            <TD width="110px">0</td>
            <TD width="100px">0</TD>
        </tr>
    <?php endforeach; ?>
</table>
<table>
    <tr align="center">
        <td width="460px" align="left"><b>Итого по счету:</b></td>

        <td width="100px"></td>
        <td width="200px"></td>
        <td width="100px"></td>
        <td width="300px" align="right"><?php echo f_d($sum_bez_nds); ?></td>
        <td width="110px"></td>
        <td width="250px" align="right"><?php echo f_d($sum_nds); ?></td>
        <td width="320px" align="right"><?php echo f_d($sum); ?></td>
        <td width="230px"></td>
        <td width="100px"></td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td align="center">ИТОГО: <?php echo num2str($sum); ?></td>
    </tr>
</table>
<br/>
<br/>
<table width="100%" align=left>
    <tr>
        <td align="left"><b>Руководитель организации:</b></td>
        <td align="right"><b>ВЫДАЛ (ответственное лицо поставщика) </b></td>
    </tr>
    <tr>
        <td align="left"></td>
        <td align="right"></td>
    </tr>
    <tr>
        <td align="left"><?php echo trim($org->director); ?> ___________</td>
        <td align="right">Техник ____________________________</td>
    </tr>
    <tr>
        <td align="left">(Ф.И.О.,подпись)</td>
        <td align="right">(Ф.И.О.,подпись)</td>
    </tr>
    <tr>
        <td align="center"></td>
        <td align="center"></td>
    </tr>
    <tr>
        <td align="left"><b>Главный бухгалтер организации:</b></td>
        <td align="right">Бухгалтер потребителя</td>
    </tr>
    <tr>
        <td align="left"></td>
        <td align="right"></td>
    </tr>
    <tr>
        <td align="left"><?php echo trim($org->glav_buh); ?> ____________</td>
        <td align="right">____________________________</td>
    </tr>
    <tr>
        <td align="left">(Ф.И.О.,подпись)</td>
        <td align="right">(Ф.И.О.,подпись)</td>
    </tr>
</table>


</body>
</html>