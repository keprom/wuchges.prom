<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сравнение дифф.тарифа и среднеотпускного</title>
</head>
<body>
<table border='1px' cellspacing='0px'>
    <thead>
    <tr align="center">
        <td colspan="17"><b><?php echo $org_info->org_name; ?></b></td>
    </tr>
    <tr align="center">
        <td colspan="17">Сравнение дифференцированного и среднеотпускного тарифов за 2016 год</td>
    </tr>
    <tr>
        <td rowspan="2">Потребители</td>
        <td align="center" colspan="3">Дневной</td>
        <td align="center" colspan="3">Вечерний</td>
        <td align="center" colspan="3">Ночной</td>
        <td colspan="3">Итого по дифференцированному тарифу</td>
        <td colspan="3">Среднеотпускной тариф</td>
        <td colspan="1">Разница</td>
    </tr>
    <tr>
        <td>кВт/ч</td>
        <td>тенге</td>
        <td>тариф</td>
        <td>кВт/ч</td>
        <td>тенге</td>
        <td>тариф</td>
        <td>кВт/ч</td>
        <td>тенге</td>
        <td>тариф</td>
        <td>кВт/ч</td>
        <td>тенге</td>
        <td>тариф</td>
        <td>кВт/ч</td>
        <td>тенге</td>
        <td>тариф</td>
        <td>в тенге</td>
    </tr>
    </thead>
    <tbody>
    <?php
    $sum_t1_kvt = 0;
    $sum_t1_tenge = 0;
    $sum_t2_kvt = 0;
    $sum_t2_tenge = 0;
    $sum_t3_kvt = 0;
    $sum_t3_tenge = 0;
    $sum_diff_kvt = 0;
    $sum_diff_tenge = 0;
    $sum_sred_kvt = 0;
    $sum_sred_tenge = 0;
    $sum_raz = 0;
    $gsum_t1_kvt = 0;
    $gsum_t1_tenge = 0;
    $gsum_t2_kvt = 0;
    $gsum_t2_tenge = 0;
    $gsum_t3_kvt = 0;
    $gsum_t3_tenge = 0;
    $gsum_diff_kvt = 0;
    $gsum_diff_tenge = 0;
    $gsum_sred_kvt = 0;
    $gsum_sred_tenge = 0;
    $gsum_raz = 0;
    $prev_fsg = -1;
    ?>
    <?php for ($i = 0; $i < count($sumtwodiff); $i++) { ?>
        <?php $diff = $sumtwodiff[$i]; ?>
        <?php
        $sum_t1_kvt += $diff->sum_t1_kvt;
        $sum_t1_tenge += $diff->sum_t1_tenge;

        $sum_t2_kvt += $diff->sum_t2_kvt;
        $sum_t2_tenge += $diff->sum_t2_tenge;

        $sum_t3_kvt += $diff->sum_t3_kvt;
        $sum_t3_tenge += $diff->sum_t3_tenge;

        $sum_diff_kvt += $diff->sikd;
        $sum_diff_tenge += $diff->sitd;

        $sum_sred_kvt += $diff->sikd;
        $sum_sred_tenge += $diff->sits;

        $sum_raz += $diff->sdms;

        $gsum_t1_kvt += $diff->sum_t1_kvt;
        $gsum_t1_tenge += $diff->sum_t1_tenge;

        $gsum_t2_kvt += $diff->sum_t2_kvt;
        $gsum_t2_tenge += $diff->sum_t2_tenge;

        $gsum_t3_kvt += $diff->sum_t3_kvt;
        $gsum_t3_tenge += $diff->sum_t3_tenge;

        $gsum_diff_kvt += $diff->sikd;
        $gsum_diff_tenge += $diff->sitd;

        $gsum_sred_kvt += $diff->sikd;
        $gsum_sred_tenge += $diff->sits;

        $gsum_raz += $diff->sdms;
        ?>
        <!--group name-->
        <?php if ($i == 0) { ?>
            <tr style="background-color: #e8e8e8">
                <td colspan="17"><b><?php echo $diff->firm_subgroup_name; ?></b></td>
            </tr>
        <?php } ?>
        <?php if ((isset($sumtwodiff[$i - 1])) AND ($sumtwodiff[$i - 1]->firm_subgroup_id != $sumtwodiff[$i]->firm_subgroup_id)) { ?>
            <tr style="background-color: #e8e8e8">
                <td colspan="17"><b><?php echo $diff->firm_subgroup_name; ?></b></td>
            </tr>
        <?php } ?>
        <!--end group name-->

        <?php if (($diff->sdms) !== NULL AND ($diff->sdms > 0)) { ?>
            <tr>
                <td style="width: 300px"><?php echo $diff->firm_name; ?></td>
                <td align="right"><?php echo prettify_number($diff->sum_t1_kvt); ?></td>
                <td align="right"><?php echo prettify_number($diff->sum_t1_tenge); ?></td>
                <td align="right"><?php echo($diff->sum_t1_kvt > 0 ? prettify_number($diff->sum_t1_tenge / $diff->sum_t1_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($diff->sum_t2_kvt); ?></td>
                <td align="right"><?php echo prettify_number($diff->sum_t2_tenge); ?></td>
                <td align="right"><?php echo($diff->sum_t2_kvt > 0 ? prettify_number($diff->sum_t2_tenge / $diff->sum_t2_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($diff->sum_t3_kvt); ?></td>
                <td align="right"><?php echo prettify_number($diff->sum_t3_tenge); ?></td>
                <td align="right"><?php echo($diff->sum_t3_kvt > 0 ? prettify_number($diff->sum_t3_tenge / $diff->sum_t3_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($diff->sikd); ?></td>
                <td align="right"><?php echo prettify_number($diff->sitd); ?></td>
                <td align="right"><?php echo($diff->sikd > 0 ? prettify_number($diff->sitd / $diff->sikd) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($diff->sikd); ?></td>
                <td align="right"><?php echo prettify_number($diff->sits); ?></td>
                <td align="right"><?php echo($diff->sikd > 0 ? prettify_number($diff->sits / $diff->sikd) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($diff->sdms); ?></td>
            </tr>
        <?php } ?>

        <?php if ((isset($sumtwodiff[$i + 1]) and ($sumtwodiff[$i + 1]->firm_subgroup_id != $sumtwodiff[$i]->firm_subgroup_id)) OR (!isset($sumtwodiff[$i + 1]))) { ?>
            <tr>
                <td><b>Итого по <?php echo $diff->firm_subgroup_name; ?></b></td>
                <td align="right"><?php echo prettify_number($gsum_t1_kvt); ?></td>
                <td align="right"><?php echo prettify_number($gsum_t1_tenge); ?></td>
                <td align="right"><?php echo($gsum_t1_kvt > 0 ? prettify_number($gsum_t1_tenge / $gsum_t1_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($gsum_t2_kvt); ?></td>
                <td align="right"><?php echo prettify_number($gsum_t2_tenge); ?></td>
                <td align="right"><?php echo($gsum_t2_kvt > 0 ? prettify_number($gsum_t2_tenge / $gsum_t2_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($gsum_t3_kvt); ?></td>
                <td align="right"><?php echo prettify_number($gsum_t3_tenge); ?></td>
                <td align="right"><?php echo($gsum_t3_kvt > 0 ? prettify_number($gsum_t3_tenge / $gsum_t3_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($gsum_diff_kvt); ?></td>
                <td align="right"><?php echo prettify_number($gsum_diff_tenge); ?></td>
                <td align="right"><?php echo($gsum_diff_kvt > 0 ? prettify_number($gsum_diff_tenge / $gsum_diff_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($gsum_sred_kvt); ?></td>
                <td align="right"><?php echo prettify_number($gsum_sred_tenge); ?></td>
                <td align="right"><?php echo($gsum_sred_kvt > 0 ? prettify_number($gsum_sred_tenge / $gsum_sred_kvt) : '0.00') ?></td>
                <td align="right"><?php echo prettify_number($gsum_raz); ?></td>
            </tr>
            <?php
            $gsum_t1_kvt = 0;
            $gsum_t1_tenge = 0;
            $gsum_t2_kvt = 0;
            $gsum_t2_tenge = 0;
            $gsum_t3_kvt = 0;
            $gsum_t3_tenge = 0;
            $gsum_diff_kvt = 0;
            $gsum_diff_tenge = 0;
            $gsum_sred_kvt = 0;
            $gsum_sred_tenge = 0;
            $gsum_raz = 0;
            ?>
        <?php } ?>

    <?php }; ?>
    <tr>
        <td><b>ИТОГО</b></td>
        <td align="right"><b><?php echo prettify_number($sum_t1_kvt); ?></b></td>
        <td align="right"><b><?php echo prettify_number($sum_t1_tenge); ?></b></td>
        <td align="right"><?php echo($sum_t1_kvt > 0 ? prettify_number($sum_t1_tenge / $sum_t1_kvt) : '0.00') ?></td>
        <td align="right"><b><?php echo prettify_number($sum_t2_kvt); ?></b></td>
        <td align="right"><b><?php echo prettify_number($sum_t2_tenge); ?></b></td>
        <td align="right"><?php echo($sum_t2_kvt > 0 ? prettify_number($sum_t2_tenge / $sum_t2_kvt) : '0.00') ?></td>
        <td align="right"><b><?php echo prettify_number($sum_t3_kvt); ?></b></td>
        <td align="right"><b><?php echo prettify_number($sum_t3_tenge); ?></b></td>
        <td align="right"><?php echo($sum_t3_kvt > 0 ? prettify_number($sum_t3_tenge / $sum_t3_kvt) : '0.00') ?></td>
        <td align="right"><b><?php echo prettify_number($sum_diff_kvt); ?></b></td>
        <td align="right"><b><?php echo prettify_number($sum_diff_tenge); ?></b></td>
        <td align="right"><?php echo($sum_diff_kvt > 0 ? prettify_number($sum_diff_tenge / $sum_diff_kvt) : '0.00') ?></td>
        <td align="right"><b><?php echo prettify_number($sum_sred_kvt); ?></b></td>
        <td align="right"><b><?php echo prettify_number($sum_sred_tenge); ?></b></td>
        <td align="right"><?php echo($sum_sred_kvt > 0 ? prettify_number($sum_sred_tenge / $sum_sred_kvt) : '0.00') ?></td>
        <td align="right"><b><?php echo prettify_number($sum_raz); ?></b></td>
    </tr>
    </tbody>
</table>
</body>
</html>