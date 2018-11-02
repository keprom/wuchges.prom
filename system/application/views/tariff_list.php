<?php echo anchor("billing/pre_perehod", "В сервис"); ?>
<h3>Список тарифов</h3>
<h5>
    <table class="border-table">
        <thead>
        <tr>
            <th>Тариф</th>
            <th>Полное наименование</th>
            <th>кВт</th>
            <th>Значение</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tariff_list as $t): ?>
            <tr>
                <td><?php echo anchor("billing/tariff/{$t->tariff_id}", $t->tariff_name); ?></td>
                <td><?php echo $t->tariff_type_name; ?></td>
                <td class="td-number"><?php echo $t->tariff_kvt; ?></td>
                <td class="td-number"><?php echo $t->tariff_value; ?></td>
                <td align="right"><?php echo $t->tariff_data; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</h5>
<br>
<?php echo form_open("billing/adding_tariff"); ?>
<table>
    <tr>
        <td>Наименование тарифа</td>
        <td><input name="name"></td>
    </tr>
    <tr>
        <td>Длинное название тарифа</td>
        <td><input name="type_name"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value='Добавить тариф'/></td>
    </tr>
</table>
<?php echo form_close(); ?>
