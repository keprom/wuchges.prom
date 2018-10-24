<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url() . 'css/fullpage.css'; ?>">
    <title>Document</title>
</head>
<body>
<table class="border-table">
<caption><?php echo $title;?></caption>
    <tr>
        <th rowspan="2">Дог</th>
        <th rowspan="2">Потребитель</th>
		<th rowspan="2">бин</th>
        <th colspan="2">Январь</th>
        <th colspan="2">Февраль</th>
        <th colspan="2">Март</th>
        <th colspan="2">Апрель</th>
        <th colspan="2">Май</th>
        <th colspan="2">Июнь</th>
        <th colspan="2">Июль</th>
        <th colspan="2">Авгус</th>
        <th colspan="2">Сентябрь</th>
        <th colspan="2">Октябрь</th>
        <th colspan="2">Ноябрь</th>
        <th colspan="2">Декабрь</th>
        <th colspan="2">Итого по организации</th>
    </tr>
    <tr>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
        <td>кВт</td>
        <td>тенге</td>
    </tr>
    <?php
    $sum_m1_kvt = 0;
    $sum_m1_tenge = 0;
    $sum_m2_kvt = 0;
    $sum_m2_tenge = 0;
    $sum_m3_kvt = 0;
    $sum_m3_tenge = 0;
    $sum_m4_kvt = 0;
    $sum_m4_tenge = 0;
    $sum_m5_kvt = 0;
    $sum_m5_tenge = 0;
    $sum_m6_kvt = 0;
    $sum_m6_tenge = 0;
    $sum_m7_kvt = 0;
    $sum_m7_tenge = 0;
    $sum_m8_kvt = 0;
    $sum_m8_tenge = 0;
    $sum_m9_kvt = 0;
    $sum_m9_tenge = 0;
    $sum_m10_kvt = 0;
    $sum_m10_tenge = 0;
    $sum_m11_kvt = 0;
    $sum_m11_tenge = 0;
    $sum_m12_kvt = 0;
    $sum_m12_tenge = 0;
    $sum_org_kvt = 0;
    $sum_org_tenge = 0;
    ?>
    <?php foreach ($report as $r): ?>
        <tr>
            <td><?php echo $r->dogovor; ?></td>
            <td><?php echo $r->name; ?></td>
			<td><?php echo $r->bin; ?></td>
            <td class="td-number"><?php echo prettify_number($r->m1_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m1_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m2_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m2_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m3_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m3_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m4_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m4_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m5_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m5_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m6_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m6_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m7_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m7_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m8_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m8_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m9_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m9_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m10_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m10_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m11_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m11_tenge); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m12_kvt); ?></td>
            <td class="td-number"><?php echo prettify_number($r->m12_tenge); ?></td>
            <?php $org_kvt =
                $r->m1_kvt +
                $r->m2_kvt +
                $r->m3_kvt +
                $r->m4_kvt +
                $r->m5_kvt +
                $r->m6_kvt +
                $r->m7_kvt +
                $r->m8_kvt +
                $r->m9_kvt +
                $r->m10_kvt +
                $r->m11_kvt +
                $r->m12_kvt;
            ?>
            <td class="td-number"><?php echo $org_kvt; ?></td>
            <?php $org_tenge =
                $r->m1_tenge +
                $r->m2_tenge +
                $r->m3_tenge +
                $r->m4_tenge +
                $r->m5_tenge +
                $r->m6_tenge +
                $r->m7_tenge +
                $r->m8_tenge +
                $r->m9_tenge +
                $r->m10_tenge +
                $r->m11_tenge +
                $r->m12_tenge;
            ?>
            <td class="td-number"><?php echo $org_tenge; ?></td>
            <?php
            $sum_m1_kvt += $r->m1_kvt;
            $sum_m1_tenge += $r->m1_tenge;
            $sum_m2_kvt += $r->m2_kvt;
            $sum_m2_tenge += $r->m2_tenge;
            $sum_m3_kvt += $r->m3_kvt;
            $sum_m3_tenge += $r->m3_tenge;
            $sum_m4_kvt += $r->m4_kvt;
            $sum_m4_tenge += $r->m4_tenge;
            $sum_m5_kvt += $r->m5_kvt;
            $sum_m5_tenge += $r->m5_tenge;
            $sum_m6_kvt += $r->m6_kvt;
            $sum_m6_tenge += $r->m6_tenge;
            $sum_m7_kvt += $r->m7_kvt;
            $sum_m7_tenge += $r->m7_tenge;
            $sum_m8_kvt += $r->m8_kvt;
            $sum_m8_tenge += $r->m8_tenge;
            $sum_m9_kvt += $r->m9_kvt;
            $sum_m9_tenge += $r->m9_tenge;
            $sum_m10_kvt += $r->m10_kvt;
            $sum_m10_tenge += $r->m10_tenge;
            $sum_m11_kvt += $r->m11_kvt;
            $sum_m11_tenge += $r->m11_tenge;
            $sum_m12_kvt += $r->m12_kvt;
            $sum_m12_tenge += $r->m12_tenge;
            $sum_org_kvt += $org_kvt;
            $sum_org_tenge += $org_tenge;
            ?>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="2">ИТОГО</td>
        <td class="td-number"><?php echo prettify_number($sum_m1_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m1_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m2_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m2_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m3_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m3_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m4_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m4_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m5_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m5_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m6_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m6_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m7_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m7_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m8_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m8_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m9_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m9_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m10_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m10_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m11_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m11_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m12_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_m12_tenge); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_org_kvt); ?></td>
        <td class="td-number"><?php echo prettify_number($sum_org_tenge); ?></td>
    </tr>
</table>
</body>
</html>