<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2-РЭ (пеня)</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'css/fullpage.css'; ?>">
</head>
<body>

<?php
$itog_ds = 0;
$itog_ks = 0;
$itog_n = 0;
$itog_o = 0;
$itog_de = 0;
$itog_ke = 0;
?>
<table class="border-table">
    <caption>
        <h2>Отчет по оплате неустойки групп потребителей за <?php echo $period_name; ?>
            <?php if (isset($ture_name) != NULL) echo ' по ТУРЭ ' . $ture_name; ?>
        </h2>
    </caption>
    <thead>
    <tr>
        <th rowspan=2>Наименование</th>
        <th colspan=2>Сальдо на начало периода</th>
        <th rowspan=2>Начислено</th>
        <th rowspan=2>Оплачено</th>
        <th colspan=2>Сальдо на конец периода</th>
    </tr>
    <tr>
        <th>Дебет</th>
        <th>Кредит</th>
        <th>Дебет</th>
        <th>Кредит</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($re as $r): ?>
        <tr>
            <td><?php echo $r->firm_subgroup_name; ?></td>
            <td class="td-number"><?php echo prettify_number($r->sum_debet_start); ?></td>
            <td class="td-number"><?php echo prettify_number($r->sum_kredit_start); ?></td>
            <td class="td-number"><?php echo prettify_number($r->sum_nachisleno); ?></td>
            <td class="td-number"><?php echo prettify_number($r->sum_oplata); ?></td>
            <td class="td-number"><?php echo prettify_number($r->sum_debet_end); ?></td>
            <td class="td-number"><?php echo prettify_number($r->sum_kredit_end); ?></td>
        </tr>
        <?php
        $itog_ds += $r->sum_debet_start;
        $itog_ks += $r->sum_kredit_start;
        $itog_n += $r->sum_nachisleno;
        $itog_o += $r->sum_oplata;
        $itog_de += $r->sum_debet_end;
        $itog_ke += $r->sum_kredit_end;
        ?>
    <?php endforeach; ?>
    <tr>
        <td><b>ИТОГО</b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_ds); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_ks); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_n); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_o); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_de); ?></b></td>
        <td class="td-number"><b><?php echo prettify_number($itog_ke); ?></b></td>
    </tr>
    </tbody>
</table>
</body>
</html>