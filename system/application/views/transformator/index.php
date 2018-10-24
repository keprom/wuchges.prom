<?php echo anchor("billing/point/" . $bill_id, "Назад к точке учета"); ?><br><br>
<?php if (empty($t)): ?>
    <?php echo form_open("billing/add_transformator"); ?>
    <fieldset>
        <legend>Установка трансформатора</legend>
        <table>
            <tr>
                <td>Наименование</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Дата последней гос.поверки</td>
                <td><input type="date" name="data_gp"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Добавить"></td>
            </tr>
        </table>
    </fieldset>
    <input type="hidden" name="bill_id" value="<?php echo $bill_id; ?>">
    <?php echo form_close(); ?>
<?php else: ?>
    <?php echo form_open("billing/edit_transformator"); ?>
    <fieldset>
        <legend>Информация о трансформаторе</legend>
        <table>
            <tr>
                <td>Наименование</td>
                <td><input type="text" name="name" value="<?php echo $t->name; ?>"></td>
            </tr>
            <tr>
                <td>Дата последней гос. поверки</td>
                <td><input type="date" name="data_gp" value="<?php echo $t->data_gp; ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Сохранить"></td>
                <td><?php echo anchor("billing/delete_transformator/" . $bill_id, "Удалить"); ?></td>
            </tr>
        </table>
    </fieldset>
    <input type="hidden" name="id" value="<?php echo $t->id; ?>">
    <?php echo form_close(); ?>
<?php endif; ?>




