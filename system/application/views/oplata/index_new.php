<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/fullpage.css">
    <link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
    <title>Работа с оплатой</title>
</head>
<body>
<?php echo form_open('billing/adding_oplata'); ?>
<table>
    <tr>
        <td>Дата</td>
        <td><input name="data" autocomplete="off" value='<?php echo $this->session->userdata('data'); ?>'></td>
    </tr>
    <tr>
        <td>Номер счета</td>
        <td><input name="payment_number" value='<?php echo $this->session->userdata('number'); ?>'></td>
    </tr>
    <tr>
        <td>Договор</td>
        <td><input name="dogovor" autocomplete="off"></td>
    </tr>
    <tr>
        <td>Сумма</td>
        <td><input name="value" autocomplete="off"></td>
    </tr>
    <tr>
        <td>Номер документа</td>
        <td><input name="document_number" autocomplete="off"></td>
    </tr>
    <tr>
        <td>Акт</td>
        <td>
            <select name="is_akt">
                <option value="true">Пометить как акт</option>
                <option selected value="false">Не помечать как акт</option>
            </select>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <input name=nds type=hidden value=12>
            <input type=submit value="Добавить оплату">
        </td>
    </tr>
</table>
<?php echo form_close(); ?>
<br>
<?php echo form_open('billing/change_oplata_period'); ?>
<table>
    <tr>
        <td colspan="3">Установить период</td>
    </tr>
    <tr>
        <td><input name=begin_data value='<?php echo $this->session->userdata('begin_data'); ?>'></td>
        <td><input name=end_data value='<?php echo $this->session->userdata('end_data'); ?>'></td>
        <td><input type=submit value=Подтвердить></td>
    </tr>
</table>
<?php echo form_close(); ?>
<br>
<?php $last_opl_data = -1; ?>
<table class="border-table stripped-table">
    <thead>
    <tr>
        <th>Номер<br>договора</th>
        <th>Дата<br>оплаты</th>
        <th>Номер<br>счета</th>
        <th>Сумма<br>оплаты</th>
        <th>НДС</th>
        <th>Сумма<br>без НДС</th>
        <th>Номер<br>документа</th>
        <th>X</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($oplata->result() as $o): ?>
        <?php if ($o->data != $last_opl_data): ?>
            <tr>
                <td colspan="8" align="center" style="background-color: #4F5155; color: white;">
                    <b><?php echo $o->data; ?></b></td>
            </tr>
            <?php $last_opl_data = $o->data; ?>
        <?php endif; ?>
        <tr>
            <td><?php echo $o->dogovor; ?></td>
            <td><?php echo $o->data; ?></td>
            <td><?php echo $o->number; ?></td>
            <td class="td-number"><?php echo prettify_number($o->value * 1.12); ?></td>
            <td class="td-number"><?php echo prettify_number($o->value * 0.12); ?></td>
            <td class="td-number"><?php echo prettify_number($o->value); ?></td>
            <td align="right"><?php echo $o->document_number; ?></td>
            <td><a href="<?php echo site_url("billing/oplata_delete/{$o->id}"); ?>">X</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>y>
</table>

</body>
</html>