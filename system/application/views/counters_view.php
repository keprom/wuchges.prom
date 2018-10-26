<?php
function datetostring($date)
{
    $d = explode("-", $date);
    return $d['2'] . '/' . $d['1'] . '/' . $d['0'];
}

?>
<?php echo anchor(base_url() . "/billing/firm/" . $point_data->firm_id, "Назад к фирме") . "<br>";
if ($this->session->flashdata('is_deleted') == -1)
    echo "<h3>Счетчик успешно удален</h3>";
if ($this->session->flashdata('is_deleted') == 1)
    echo "<h3>Счетчик не удален в виду наличия на нем показаний за прошлые периоды</h3>";

?>

<h3><b>Точка учета <?php echo $point_data->name; ?></b></h3>
<table class="border-table">
    <tr>
        <td><b>Адрес</b></td>
        <td><?php echo $point_data->address; ?></td>
        <td></td>
    </tr>
    <tr>
        <td><b>Учет</b></td>
        <td><?php echo($point_data->phase == 1 ? "однофазный" : "трехфазный"); ?></td>
        <td></td>
    </tr>
    <?php if (!empty($last_ins_check)): ?>
        <tr>
            <td><b>Последняя инст.проверка</b></td>
            <td>Акт №<?php echo $last_ins_check->act_number; ?> от <?php echo $last_ins_check->data; ?>
            </td>
            <td>
                <?php echo form_open("billing/del_ins_check"); ?>
                <input type="hidden" name="id" value="<?php echo $last_ins_check->id; ?>">
                <input type="hidden" name="bill_id" value="<?php echo $point_data->id; ?>">
                <input type="submit" value="X">
                <?php echo form_close(); ?>
            </td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="2"><b><?php echo anchor("billing/transformator/" . $point_data->id, "Трансформатор"); ?></b></td>
        <td></td>
    </tr>
</table>
<br/>

<b>установленные счетчики на точке учета:</b><br/>
<table>
    <tr>
        <td>Тип счетчика</td>
        <td>Гос номер</td>
        <td>Дата гос проверки</td>
        <td>Дата снятия</td>
    </tr>
    <?php foreach ($query->result() as $row): ?>
        <?php if ($row->data_gos_proverki == "") $gprov = " - "; else $gprov = $row->data_gos_proverki; ?>
        <?php if ($row->data_finish == "") $edate = " - "; else $edate = $row->data_finish; ?>
        <tr>
            <td><?php echo anchor("billing/counter/" . $row->id, $row->type); ?> </td>
            <td><?php echo anchor("billing/counter/" . $row->id, $row->gos_nomer); ?></td>
            <td><?php echo anchor("billing/counter/" . $row->id, $gprov); ?></td>
            <td><?php echo anchor("billing/counter/" . $row->id, $edate); ?></td>
            <td><?php echo anchor("billing/delete_counter/" . $row->id, "Удалить"); ?></td>
            <td><?php echo anchor("billing/delete_counter_close/{$row->id}/{$point_data->id}", "Убрать снятие"); ?></td>

        </tr>
    <?php endforeach; ?>
</table>
<br><br><br>
<hr/>
<br>
<?php if ($snyat) {
    echo form_open("billing/break_counter");
    echo "<input type=hidden name=point_id value=" . $point_data->id . " /><br/>";
    echo "День<input name=day size=5> месяц <input name=month size=5> год <input name=year size=10> ";
    echo "<input type=submit value=\"снять счетчик\">";
    echo "</form>";
}
?>
<br><br>
<hr/>
<br>
<fieldset>
    <legend>Инструментальная проверка</legend>
    <?php echo form_open("billing/add_ins_check"); ?>
    <input type="hidden" name="bill_id" value="<?php echo $point_data->id; ?>">
    <table>
        <tr>
            <td>№ акта</td>
            <td><input type="text" name="act_number"></td>
        </tr>
        <tr>
            <td>Дата акта</td>
            <td><input type="date" name="data"></td>
        </tr>
        <tr>
            <td>Примечание</td>
            <td><input type="text" name="notice"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Добавить"></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</fieldset>
<br>
<br>
<hr>