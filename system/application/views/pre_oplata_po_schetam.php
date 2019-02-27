<?php echo form_open("billing/oplata_po_schetam"); ?>
<table>
    <thead>
    <tr>
        <th align="center">Месяц</th>
        <th align="center">Стартовая дата</th>
        <th align="center">Окончательная дата</th>
        <th align="center">Бух.счет</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <select name=period_id>
                <?php foreach ($period->result() as $p): ?>
                    <option value=<?php echo $p->id; ?>><?php echo $p->name; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><input name='start' autocomplete="off"></td>
        <td><input name='end' autocomplete="off"></td>
        <td>
            <select name="payment_id" id="">
                <option value="-1">Все</option>
                <?php foreach ($payment_number as $p): ?>
                <option value="<?php echo $p->id; ?>"><?php echo $p->number; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td align="right" colspan="5"><input type=submit value='Выдать отчет'/></td>
    </tr>
    </tbody>
</table>
<?php echo form_close(); ?>