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
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>