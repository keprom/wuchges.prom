<?php
function datetostring($date)
{
    $d = explode("-", $date);
    return $d['2'] . '.' . $d['1'] . '.' . $d['0'];
}

function f_d($var)
{
    if ($var == 0) return "0.00"; else
        return sprintf("%22.2f", $var);
}

$last_bill_id = 0;
$last_counter_id = 0;
$last_values_set_id = 0;
$i = 0;
$num = $pokaz->num_rows();
$j = 0;
?>
<?php echo anchor("billing/firm/" . $firm_id, "назад к фирме"); ?>
<table>
    <?php foreach ($pokaz->result() as $p): ?>

        <?php if (($last_values_set_id != 0) and ($last_values_set_id != $p->values_set_id)): ?>
            <tr>
                <td>
                    <a name="id<?php echo $j; ?>" />
                    <?php echo form_open("billing/adding_pokazanie2/" . $j, array('id' => 'form' . $j));
                    $j++ ?>
                    <b>Показание</b> <input id=<?php $p->values_set_id; ?> type="text" name="value" size="30"/><br>
                    День <input type="text" name="day" value="<?php echo $this->session->userdata('day'); ?>" size="5"/>
                    Месяц <input type="text" name="month" value="<?php echo $this->session->userdata('month'); ?>"
                                 size="5"/>
                    Год <input type="text" name="year" value="<?php echo $this->session->userdata('year'); ?>"
                               size="5"/>
                    <input type=hidden name=values_set_id value="<?php echo $last_values_set_id; ?>"/>
                    <input type=hidden name=nds value="12"/> <br/>
                    <input type='submit' value='добавить показание'/>
                    </form>
                    <a name=<?php echo $p->values_set_id; ?>>
                </td>
            </tr>
        <?php endif; ?>

        <?php if ($last_bill_id != $p->bill_id): ?>
            <tr>
                <td><?php echo "<h3><b>{$p->bill_name}</b></h3>"; ?></td>
            </tr>
        <?php endif; ?>

        <?php if ($last_counter_id != $p->counter_id): ?>
            <tr>
                <td><?php echo "Установленный счетчик:<br>Тип " . $p->counter_type_name . "<br>  
	гос. номер " . $p->counter_gos_nomer . "</br>  дата установки " . $p->counter_data_start .
                        "</br>  разрядность " . $p->digit_count .
                        "  коэфф " . $p->transform .
                        " </br>  ТП <font color=blue>" . $p->tp_name . "</font>" .
                        "  - ТУРЭ " . $p->ture_name;

                    ?>
                </td>
            </tr>
        <?php endif; ?>

        <?php if ($last_values_set_id != $p->values_set_id): ?>
            <tr>
                <td><?php echo "Тарифный план " . $p->tariff_name; ?></td>
            </tr>
        <?php endif; ?>
        <?php if ($p->counter_value_value != null): ?>
            <tr>
                <td>
                    <?php if ($p->period_id != NULL) echo "<font color=red >"; ?>
                    <?php echo datetostring($p->counter_value_data) . " &nbsp;&nbsp;" .
                        f_d($p->counter_value_value) . " &nbsp;&nbsp;" .
                        f_d($p->counter_value_diff) . " &nbsp;&nbsp;" .
                        f_d($p->counter_value_diff * $p->transform) . " &nbsp;&nbsp;" .
                        anchor('billing/delete_pokazanie2/' . $p->counter_value_id, 'x'); ?></td>
                <?php if ($p->period_id != NULL) echo "</font>"; ?>
            </tr>
        <?php endif; ?>

        <?php if ($i == $num - 1): ?>
            <tr>
                <td>

                    <?php echo form_open("billing/adding_pokazanie2/" . $j, array('id' => 'form' . $j)); ?>
                    <b>Показание</b> <input id=<?php $p->values_set_id; ?> type="text" name="value" value="" size="30"/><br>
                    День <input type="text" name="day" value="<?php echo $this->session->userdata('day'); ?>" size="5"/>
                    Месяц <input type="text" name="month" value="<?php echo $this->session->userdata('month'); ?>"
                                 size="5"/>
                    Год <input type="text" name="year" value="<?php echo $this->session->userdata('year'); ?>"
                               size="5"/>
                    <input type=hidden name=values_set_id value="<?php echo $p->values_set_id; ?>"/>
                    <input type=hidden name=nds value="12"/> <br/>
                    <input type='submit' value='добавить показание'/>
                    </form>
                    <a name=<?php $j; ?>/>
                </td>
            </tr>
        <?php endif; ?>

        <?php $last_bill_id = $p->bill_id;
        $last_counter_id = $p->counter_id;
        $last_values_set_id = $p->values_set_id;
        $i++; ?>
    <?php endforeach; ?>
</table>
<script>
    function formfocus() {
        var start = document.URL.indexOf("#");
        var end = document.URL.length;
        var anchor = document.URL.substring(start + 1, end);
        document.getElementById("form" + anchor).elements[0].focus();
        document.location.href = "#" + anchor;
    }

    window.onload = formfocus;

</script>