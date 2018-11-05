<?php echo anchor("billing/tariff_list", "Назад к списку тарифов"); ?>
    <h3>Описание тарифа <?php echo $tariff->name . " " . $tariff->type_name; ?></h3>
    <h5>
        <?php if (is_null($tariff_info[0]->data)): ?>
            <?php echo anchor("billing/delete_tariff/{$tariff->id}", "Удалить тариф") ?>
        <?php else: ?>
            <table class="border-table">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>кВт</th>
                    <th>Значение</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tariff_info as $t): ?>
                    <tr>
                        <td><?php echo $t->data; ?></td>
                        <td class="td-number"><?php echo prettify_number($t->kvt, 0); ?></td>
                        <td class="td-number"><?php echo $t->value; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <?php
                $last_date = explode("-", $t->data);
                $last_month = $last_date[1];
                $current_date = explode("-", date("Y-m-d"));
                $current_month = $current_date[1];
                ?>
                <?php if (($current_month - $last_month) <= 2): ?>
                    <tfoot>
                    <tr>
                        <td style="color: #FF0000;" align="center" colspan="3">
                            <?php echo anchor("billing/delete_tariff_value/{$t->value_id}", "Удалить последнее значение"); ?>
                        </td>
                    </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        <?php endif; ?>
        <br>
    </h5>

<?php echo form_open("billing/adding_tariff_value/{$tariff->id}"); ?>
    <table>
        <tr>
            <td>Дата установки</td>
            <td><input name="data" type="date"></td>
        </tr>
        <tr>
            <td>кВт</td>
            <td><input name="kvt" type="number" step="1" value="0"></td>
        </tr>
        <tr>
            <td>Значение тарифа</td>
            <td><input name="value" type="number" step="0.001"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value='Добавить значение тарифа'/></td>
        </tr>
    </table>
<?php echo form_close(); ?>