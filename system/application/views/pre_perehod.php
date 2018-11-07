<?php //echo anchor('billing/perehod', "Перейти в след месяц"); ?><!--<br><br>-->
<?php //echo anchor('billing/tariff_list', "Тарифы"); ?><!--<br><br>-->
<?php //echo anchor('billing/dbase', "Импортировать оплату"); ?><!--<br><br>-->
<?php //echo anchor('billing/pre_nachislenie_v_analiz', "Экспортировать начисление в анализ по тп"); ?><!--<br><br>-->
<?php //echo anchor('billing/perenos_rek1', "Перенос реквизитов"); ?><!--<br><br>-->
<?php //echo anchor('billing/perenos_nach', "Перенос начисления по уровням"); ?><!--<br><br>-->
<?php //echo anchor('billing/perenos_saldo', "Сальдо за месяц"); ?><!--<br><br>-->
<?php //echo anchor('billing/perenos_oplata', "Перенос оплаты за месяц"); ?>
<?php
$links = array(
    "billing/perehod" => array("title" => "Перейти в след месяц"),
    "billing/dbase" => array("title" => "Импортировать оплату"),
    "billing/pre_nachislenie_v_analiz" => array("title" => "Экспортировать начисление в анализ по ТП"),
    "billing/nachislenie_v_buhgalteriu" => array("title" => "Перенос начисления в бухгалтерию"),
    "billing/perenos_rek1" => array("title" => "Перенос реквизитов"),
    "billing/perenos_nach" => array("title" => "Перенос начисления по уровням"),
    "billing/tariff_list" => array("title" => "Тарифы"),
    "billing/perenos_saldo" => array("title" => "Сальдо за месяц"),
    "billing/perenos_oplata" => array("title" => "Перенос оплаты за месяц")
);
foreach ($links as $key => $value):
    if (array_key_exists($key, $last_user_actions)) {
        $links[$key]['last_time'] = $last_user_actions[$key];
    } else {
        $links[$key]['last_time'] = '-';
    }
endforeach;
?>
<table class="border-table">
    <thead>
    <tr>
        <th>Операция</th>
        <th>Дата последнего запуска</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($links as $key => $value): ?>
        <tr style="margin: 10px;">
            <td style="padding: 10px;"><?php echo anchor($key, $value['title']); ?></td>
            <td style="padding: 10px;" align="center"><?php echo $value['last_time']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>