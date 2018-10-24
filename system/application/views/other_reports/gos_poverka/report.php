<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="<?php echo base_url() . 'css/fullpage.css'; ?>">
</head>
<body>
<table class="border-table striped-table">
    <caption></caption>
    <thead>
    <tr>
        <th rowspan="2">№</th>
        <th rowspan="2">Наименование потребителя</th>
        <th rowspan="2">Точка учета</th>
        <th rowspan="2">Гос.номер счетчика</th>
        <th colspan="2">Последняя инструментальная проверка</th>
        <th colspan="2">Срок. гос. поверки</th>
        <th colspan="2">Срок следующей гос. поверки</th>
    </tr>
    <tr>
        <th>Дата</th>
        <th>№ акта</th>
        <th>Эл.счетчика</th>
        <th>Трансформаторов тока</th>
        <th>Эл.счетчика</th>
        <th>Трансформаторов тока</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($report as $r): ?>
    <tr>
        <td class="td-number"><?php echo $i++; ?></td>
        <td><?php echo $r->dogovor." ".$r->firm_name; ?></td>
        <td><?php echo $r->bill_name; ?></td>
        <td class="td-number"><?php echo $r->gos_nomer; ?></td>
        <td><?php echo $r->bpic_data; ?></td>
        <td><?php echo $r->act_number; ?></td>
        <td><?php echo $r->data_gos_proverki; ?></td>
        <td><?php echo $r->trans_data_gp; ?></td>
        <td></td>
        <td></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>