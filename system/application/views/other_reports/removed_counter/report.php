<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Снятые счетчики за год</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/fullpage.css" type="text/css" media="screen,projection"/>
</head>
<body>
<table class="border-table">
    <caption>Снятые счетчики за <?php echo $year; ?> год</caption>
    <thead>
    <tr>
        <th>№</th>
        <th>№ абонента</th>
        <th>Наименование организации</th>
        <th>№ счетчика</th>
        <th>Тип счетчика</th>
        <th>Дата замены</th>
        <th>Причина замены</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($report as $r): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $r->dogovor; ?></td>
            <td><?php echo $r->firm_name; ?></td>
            <td><?php echo $r->gos_nomer; ?></td>
            <td><?php echo $r->type_name; ?></td>
            <td><?php echo $r->data_finish; ?></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>