<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Пеня</title>
</head>
<body>
<h3>Пеня за <?php echo mb_strtolower($period->name, 'utf-8'); ?> года</h3>
<?php
$saldo = 0;
$nach = 0;
$fs_start = 0;
$fo = 0;
$fs_end = 0;
$fine = 0;
?>
<style>
    .border-table, .border-table td, .border-table tr {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .nowrap {
        white-space: nowrap;
    }
</style>
<table class="border-table" border="1px">
    <tr class="head-tr">
        <th>Договор</th>
        <th>Организация</th>
        <th>Сальдо на начало текущего месяца</th>
        <th>Начисление прошлого месяца</th>
        <th>Сальдо пени на начало месяца</th>
        <th>Пеня за текущий месяц</th>
        <th>Оплата пени за текущий месяц</th>
        <th>Сальдо пени на конец месяца</th>
    </tr>
    <?php foreach ($fine_arr as $firm_id => $firm_info): ?>
        <tr>
            <td align="center"><?php echo $firm_info['dogovor']; ?></td>
            <td width="400px"><?php echo $firm_info['name']; ?></td>
            <td align="right" class="nowrap"><?php echo prettify_number($firm_info['saldo']); ?></td>
            <td align="right" class="nowrap"><?php echo prettify_number($firm_info['nach']); ?></td>
            <td align="right" class="nowrap"><?php echo prettify_number($firm_info['fs_start']); ?></td>
            <td align="right" class="nowrap"><a
                        href='<?php echo site_url("/billing/fine_firm/{$firm_id}/{$period->id}"); ?>'><?php echo prettify_number($firm_info['fine']); ?></a>
            </td>
            <td align="right" class="nowrap"><a
                        href="<?php echo site_url("/billing/fine_firm_oplata/{$firm_id}/{$period->id}"); ?>"><?php echo prettify_number($firm_info['fo']); ?></a>
            </td>
            <td align="right" class="nowrap"><?php echo prettify_number($firm_info['fs_end']); ?></td>
        </tr>
        <?php
        $saldo += $firm_info['saldo'];
        $nach += $firm_info['nach'];
        $fs_start += $firm_info['fs_start'];
        $fo += $firm_info['fo'];
        $fs_end += $firm_info['fs_end'];
        $fine += $firm_info['fine'];
        ?>
    <?php endforeach; ?>
    <tr>
        <td colspan="2" align="left">Итого</td>
        <td align="right" class="nowrap"><?php echo prettify_number($saldo); ?></td>
        <td align="right" class="nowrap"><?php echo prettify_number($nach); ?></td>
        <td align="right" class="nowrap"><?php echo prettify_number($fs_start); ?></td>
        <td align="right" class="nowrap"><?php echo prettify_number($fine); ?></td>
        <td align="right" class="nowrap"><?php echo prettify_number($fo); ?></td>
        <td align="right" class="nowrap"><?php echo prettify_number($fs_end); ?></td>
    </tr>
</table>
</body>
</html>
