<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/fullpage.css" type="text/css">
    <style>
        html {
            background-color: #dddddd;
        }

        body {
            width: 217mm;
            background-color: #FFFFFF;
            padding: 10px;
        }

        @media print {
            body {
                width: 217mm;
                height: 270mm;
            }
        }

        #table-operation {
            font-size: smaller;
        }
    </style>
</head>
<body>


<table>
    <tbody>
    <tr>
        <td style="border: 1px solid #000; border-collapse: collapse" align="center">Предприятие, организация</td>
        <td></td>
    </tr>
    <tr>
        <td align="center"><b><?php echo $org->org_name; ?></b></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td rowspan="2" align="center" valign="middle"><h3><b>АКТ СВЕРКИ ВЗАИМОРАСЧЕТОВ</b></h3></td>
        <td style="border: 1px solid #000; border-collapse: collapse;" align="center">Номер документа</td>
        <td style="border: 1px solid #000; border-collapse: collapse;" align="center">Дата составления</td>
    </tr>
    <tr>
        <td align="center"><b><?php echo $akt_number; ?></b></td>
        <td align="center"><b><?php echo $data_akta; ?></b></td>
    </tr>
    <tr>
        <td colspan="3">Мы, нижеподписавшиеся:</td>
    </tr>
    <tr>
        <td colspan="3">
            <?php echo $org->org_name; ?> в лице главного бухгалтера ____________________________________________________ с одной стороны,
            и <?php echo $firm->name; ?> в лице
        </td>
    </tr>
    <tr>
        <td colspan="3">
            __________________________________________________________________________________________________
        </td>
    </tr>
    <tr>
        <td colspan="3" align="center">
            <sub>(должность, ФИО)</sub>
        </td>
    </tr>
    <tr>
        <td colspan="3">с другой стороны, составили настоящий акт в том, что сего числа произвели сверку взаимных
            расчетов по состоянию на <?php echo ''; ?>, причем в результате сверки выявлены расхождения, которые
            следует
            допровести:
        </td>
    </tr>
    <tr>
        <td colspan="3">Отбор по основанию (договору): <?php echo $firm->dogovor; ?></td>
    </tr>
    </tbody>
</table>

<table class="border-table" id="table-operation">
    <thead>
    <tr>
        <th rowspan="3" style=" width: 25%">Текст записи</th>
        <th colspan="4" style=" width: 37.5%"><?php echo $org->org_name; ?></th>
        <th colspan="4" style=" width: 37.5%"><?php echo $firm->name; ?></th>
    </tr>
    <tr>
        <th colspan="2">Электроэнергия</th>
        <th colspan="2">Неустойка</th>
        <th colspan="2">Электроэнергия</th>
        <th colspan="2">Неустойка</th>
    </tr>
    <tr>
        <th>Дебет</th>
        <th>Кредит</th>
        <th>Дебет</th>
        <th>Кредит</th>
        <th>Дебет</th>
        <th>Кредит</th>
        <th>Дебет</th>
        <th>Кредит</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $fm_saldo = -1;
    $itog_debet = 0;
    $itog_kredit = 0;
    $itog_fine_debet = 0;
    $itog_fine_kredit = 0;
    $saldo_fine_debet = 0;
    $saldo_fine_kredit = 0;
    $saldo_kredit = 0;
    $saldo_debet = 0;
    ?>
    <?php foreach ($akt as $a): ?>
        <tr>
            <?php
            if (($fm_saldo == 1) and ($a->type_id == 1)) {
                continue;
            }
            if ($a->type_id == 1) {
                if ($a->fine_debet > 0) {
                    $saldo_fine_debet = $a->fine_debet;
                } else {
                    $saldo_fine_kredit = $a->fine_kredit;
                }
                if ($a->debet > 0) {
                    $saldo_debet = $a->debet;
                } else {
                    $saldo_kredit = $a->kredit;
                }
                $fm_saldo = 1;
            }
            if ($a->type_id != 1) {
                $itog_debet += $a->debet;
                $itog_kredit += $a->kredit;
                $itog_fine_debet += $a->fine_debet;
                $itog_fine_kredit += $a->fine_kredit;
            }
            ?>

            <td class="nowrap"><?php
                if ($a->type_id == 1) {
                    echo "<b>" . $a->oper_name . "</b>";
                } else {
                    echo $a->oper_name;
                }
                ?></td>
            <td class="td-number"><?php echo prettify_number($a->debet); ?></td>
            <td class="td-number"><?php echo prettify_number($a->kredit); ?></td>
            <td class="td-number"><?php echo prettify_number($a->fine_debet); ?></td>
            <td class="td-number"><?php echo prettify_number($a->fine_kredit); ?></td>
            <td class="td-number"></td>
            <td class="td-number"></td>
            <td class="td-number"></td>
            <td class="td-number"></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td><b>Итого оборотов</b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_debet); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_kredit); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_fine_debet); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_fine_kredit); ?></b></td>
        <td><b></b></td>
        <td><b></b></td>
        <td><b></b></td>
        <td><b></b></td>
    </tr>
    <?php
    $saldo_fine_debet += $itog_fine_debet;
    $saldo_fine_kredit += $itog_fine_kredit;
    $saldo_kredit += $itog_kredit;
    $saldo_debet += $itog_debet;


    if (($saldo_fine_debet - $saldo_fine_kredit) > 0) {
        $saldo_fine_debet = $saldo_fine_debet - $saldo_fine_kredit;
        $saldo_fine_kredit = 0;
    } else {
        $saldo_fine_kredit = $saldo_fine_kredit - $saldo_fine_debet;
        $saldo_fine_debet = 0;
    }

    if (($saldo_debet - $saldo_kredit) > 0) {
        $saldo_debet = $saldo_debet - $saldo_kredit;
        $saldo_kredit = 0;
    } else {
        $saldo_kredit = $saldo_kredit - $saldo_debet;
        $saldo_debet = 0;
    }

    ?>
    <tr>
        <?php
        $period_end_name = substr($period_end->name, 0, strpos($period_end->name, " "));
        $pe_day = substr($period_end->end_date, 8, 2);
        $pe_year = substr($period_end->end_date, 0, 4);
        ?>
        <td><b>Сальдо
                на <?php echo $pe_day . ' ' . $period_end_name . ' ' . $pe_year . ' года'; ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($saldo_debet); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($saldo_kredit); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($saldo_fine_debet); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($saldo_fine_kredit); ?></b></td>
        <td><b></b></td>
        <td><b></b></td>
        <td><b></b></td>
        <td><b></b></td>
    </tr>
    </tbody>
</table>
<br><br>
<table style="width: 100%;">
    <tbody>
    <tr>
        <td>Руководитель</td>
        <td>______________</td>
        <td><?php echo $org->director; ?></td>
        <td>Руководитель</td>
        <td>______________</td>
        <td>______________</td>
    </tr>
    <tr>
        <td>Гл.бухгалтер</td>
        <td>______________</td>
        <td><?php echo $org->glav_buh; ?></td>
        <td>Гл.бухгалтер</td>
        <td>______________</td>
        <td>______________</td>
    </tr>
    <tr>
        <td>Исполнитель</td>
        <td>______________</td>
        <td>______________</td>
        <td>Исполнитель</td>
        <td>______________</td>
        <td>______________</td>
    </tr>
    </tbody>
</table>
</body>
</html>
