<table>
    <tbody>
    <tr>
        <td>
            <fieldset>
                <legend>Пеня за период</legend>
                <?php echo form_open('billing/fine_all_firms', "method='post'"); ?>
                <select name="period_id" id="period_id">
                    <?php foreach ($periods as $period) : ?>
                        <option value="<?php echo $period->id ?>"><?php echo $period->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Открыть">
                <?php echo form_close(); ?>
            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>Календарь</legend>
                <?php echo form_open('billing/current_year_calendar', 'method="post"'); ?>
                <input type="submit" value="Текущий год">
                <?php echo form_close(); ?>
            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>Параметры пени</legend>
                <?php echo form_open('billing/fine_all_firm_options'); ?>
                <input type="submit" value="Все организации">
                <?php echo form_close(); ?>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>

<table>
    <tr>
        <td>
            <fieldset>
                <legend>Ставки рефинансирования</legend>
                <table class="border-table">
                    <thead>
                    <tr class="head-tr">
                        <th>Дата</th>
                        <th>Ставка</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ref_rates as $ref_rate): ?>
                        <tr>
                            <td><?php echo $ref_rate->data; ?></td>
                            <td align="right"><?php echo $ref_rate->value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
                <fieldset>
                    <legend>Добавить ставку</legend>
                    <?php echo form_open('billing/fine_info', 'method="post"'); ?>
                    <label for="data">Дата (ГГГГ-ММ-ДД)</label>
                    <input type="text" name="rate_data" maxlength="10">
                    <label for="value">Значение</label>
                    <input type="text" name="rate_value">
                    <input type="submit" name="add_ref_rate" id="add_ref_rate" value="Добавить">
                    <?php echo form_close(); ?>
                </fieldset>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td>
            <fieldset>
                <legend>Коэффициенты</legend>
                <table class="border-table">
                    <thead>
                    <tr class="head-tr">
                        <th>Дата</th>
                        <th>Коэф.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($ref_coefs as $ref_coef): ?>
                        <tr>
                            <td><?php echo $ref_coef->data; ?></td>
                            <td align="right"><?php echo $ref_coef->value; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <br>
                <fieldset>
                    <legend>Добавить коэффициент</legend>
                    <?php echo form_open('billing/fine_info', 'method="post"'); ?>
                    <label for="data">Дата (ГГГГ-ММ-ДД)</label>
                    <input type="text" name="coef_data">
                    <label for="value">Значение</label>
                    <input type="text" name="coef_value">
                    <input type="submit" name="add_ref_coef" id="add_ref_coef" value="Добавить">
                    <?php echo form_close(); ?>
                </fieldset>
            </fieldset>
        </td>
    </tr>
</table>