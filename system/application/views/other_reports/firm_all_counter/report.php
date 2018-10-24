<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Все счетчики</title>
    <link rel="stylesheet" href="<?php echo base_url() . 'css/fullpage.css'; ?>">
</head>
<body>
<table class="border-table">
    <thead>
    <tr>
        <th>№</th>
        <th>Договор</th>
        <th>Наименование организации</th>
        <th>Гос. номер счетчика</th>
        <th>Тип счетчика</th>
        <th>Дата ввода в эксплуатацию</th>
        <th>Дата вывода из эксплуатации</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $last_sgid = -1;
    $i = 1;
    ?>
    <?php foreach ($report as $r): ?>
        <?php if ($r->subgroup_id != $last_sgid): ?>
            <tr>
                <td colspan="7"><b><?php echo $r->subgroup_name; ?></b></td>
            </tr>
            <?php $last_sgid = $r->subgroup_id; ?>
        <?php endif; ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $r->dogovor; ?></td>
            <td><?php echo $r->firm_name; ?></td>
            <td><?php echo $r->gos_nomer; ?></td>
            <td><?php echo $r->type_name; ?></td>
            <td><?php echo $r->data_start; ?></td>
            <td><?php echo $r->data_finish; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>