<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Образование сальдо</title>
    <style>
        .border-table, .border-table td, .border-table tr, .border-table th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<?php echo anchor(base_url()."/billing/fine/".$firm_info->id,"Назад" )."<br><br>";?>
<table class="border-table">
    <caption>
        <?php echo '№' . $firm_info->dogovor . ' ' . $firm_info->name; ?>
    </caption>
    <thead>
    <tr>
        <th>Месяц</th>
        <th>Сальдо пени <br>на начало месяца</th>
        <th>Начислено пени <br>на конец месяца</th>
        <th>Оплачено пени</th>
        <th>Сальдо пени на <br>конец месяца</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($fine_saldo_origin as $fso): ?>
        <tr>
            <td><?php echo $fso->period_name; ?></td>
            <td align="right"><?php echo prettify_number($fso->saldo_begin_value); ?></td>
            <td align="right">
                <a href="<?php echo site_url() . "/billing/fine_firm/{$firm_info->id}/{$fso->period_id}"; ?>">
                    <?php echo prettify_number($fso->fine_value); ?>
                </a>
            </td>
            <td align="right">
                <a href="<?php echo site_url() . "/billing/fine_firm_oplata/{$firm_info->id}/{$fso->period_id}"; ?>">
                    <?php echo prettify_number($fso->fine_oplata_value); ?>
                </a>
            </td>
            <td align="right"><?php echo prettify_number($fso->saldo_end_value); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
