<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Для сверки выгрузки</title>
    <link rel="stylesheet" href="/css/fullpage.css">
</head>
<body>

<table class="border-table">
    <thead>
    <tr>
        <th>Договор</th>
        <th>Наименование</th>
        <th>кВт</th>
        <th>Тарифф</th>
        <th>Сумма без НДС</th>
        <th>Сумма с НДС</th>
        <th>Номер СФ</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $itog_kvt = 0;
    $sum_snds = 0;
    $sum_beznds = 0;
    ?>
    <?php foreach ($report as $r): ?>
        <tr>
            <td><?php echo $r->dog; ?></td>
            <td><?php echo $r->name; ?></td>
            <td class="td-number"><?php echo $r->kvt; ?></td>
            <td class="td-number"><?php echo $r->tarif; ?></td>
            <td class="td-number"><?php echo $r->beznds; ?></td>
            <td class="td-number"><?php echo $r->snds; ?></td>
            <td class="td-number"><?php echo $r->nomer; ?></td>
        </tr>
        <?php
        $itog_kvt += $r->kvt;
        $sum_snds += $r->beznds;
        $sum_beznds += $r->snds;
        ?>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th colspan="2">ИТОГО</th>
        <th class="th-number"><?php echo $itog_kvt; ?></th>
        <th></th>
        <th class="th-number"><?php echo $sum_snds; ?></th>
        <th class="th-number"><?php echo $sum_beznds; ?></th>
        <th></th>
    </tr>
    </tfoot>
</table>

</body>
</html>