<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список контрагентов с реквизитами</title>
    <link rel="stylesheet" href="/css/fullpage.css" type="text/css">
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
</head>
<body>
<table class="border-table">
    <thead>
    <tr>
        <th>№</th>
        <th>Договор</th>
        <th>Наименование организации</th>
        <th>БИН</th>
        <th>Номер банковского счета</th>
        <th>Наименование банка</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($report as $r): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $r->dogovor; ?></td>
            <td><?php echo $r->firm_name; ?></td>
            <td><?php echo $r->bin; ?></td>
            <td><?php echo $r->schet; ?></td>
            <td><?php echo $r->bank_name; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>