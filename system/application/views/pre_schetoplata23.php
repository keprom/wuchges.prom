<?php
function datetostring($date)
{
    $d = explode("-", $date);
    return $d['2'] . '.' . $d['1'] . '.' . $d['0'];
}

echo form_open("billing/schetoplata");
echo "<input type=hidden name=firm_id value=" . $firm_id . " >";
echo "<input type=hidden name=period_id value=" . $period_id . " >";
echo "<input type=hidden name=tariff_count value=" . $tariffs->num_rows() . " >";
echo "Другая дата <input  name=data_schet value='" . date("d.m.Y") . "' ><br>";
echo "Накладная на отпуск <input  name=schet2 type=checkbox /><br>";
echo "Включая данные ндс <input  name=schet2full type=checkbox /><br>";
echo "За период с <input  name=data_start value='" . datetostring($period->begin_date) . "' ><br>";
echo "<input  name=data_finish value='" . datetostring($period->end_date) . "' ><br>";
echo "<input type=hidden name=type value='by_tenge' >";
echo "Выдать счет фактурой <input type=checkbox name=schet  ><br>";
?>

    Условия оплаты по договору: <input name=edit1 value='<?php echo $firm->edit1; ?>'> <br>
    Пункт назначения поставляемых товаров (работ, услуг): <input name=edit2 value='<?php echo $firm->edit2; ?>'> <br>
    Поставка товаров осуществлена по доверености: <input name=edit3 value='<?php echo $firm->edit3; ?>'> <br>
    Способ отправления: <input name=edit4 value='<?php echo $firm->edit4; ?>'> <br>
    Грузоотправитель:<input name=edit5 value='<?php echo $firm->edit5; ?>'> <br>
    Грузополучатель:<input name=edit6 value='<?php echo $firm->edit6; ?>'> <br>

<?php
$i = 0;
foreach ($tariffs->result() as $tariff) {
    echo "Сумма тенге <input name=tariff[{$i}] > по тарифу {$tariff->tariff_value}<br>";
    echo "<input type=hidden name=tariff_value[{$i}] value='{$tariff->tariff_value}' >";
    $i++;
}
echo "<input type=submit value='Открыть счет на оплату' />";
echo "</form>";


echo form_open("billing/schetoplata");
echo "<input type=hidden name=firm_id value=" . $firm_id . " >";
echo "<input type=hidden name=type value='by_kvt' >";
echo "<input type=hidden name=period_id value=" . $period_id . " >";
echo "<input type=hidden name=tariff_count value=" . $tariffs->num_rows() . " >";
echo "Другая дата <input  name=data_schet value='" . date("d.m.Y") . "' ><br>";
echo "Накладная на отпуск <input  name=schet2 type=checkbox /><br>";
echo "Включая данные ндс <input  name=schet2full type=checkbox /><br>";
echo "За период с <input  name=data_start value='{$period->begin_date}' ><br>";
echo "по <input  name=data_finish value='{$period->end_date}' ><br>";

echo "Выдать счет фактурой <input type=checkbox name=schet   ><br>";
?>

    Условия оплаты по договору: <input name=edit1 value='<?php echo $firm->edit1; ?>'> <br>
    Пункт назначения поставляемых товаров (работ, услуг): <input name=edit2 value='<?php echo $firm->edit2; ?>'> <br>
    Поставка товаров осуществлена по доверености: <input name=edit3 value='<?php echo $firm->edit3; ?>'> <br>
    Способ отправления: <input name=edit4 value='<?php echo $firm->edit4; ?>'> <br>
    Грузоотправитель:<input name=edit5 value='<?php echo $firm->edit5; ?>'> <br>
    Грузополучатель:<input name=edit6 value='<?php echo $firm->edit6; ?>'> <br>

<?php
$i = 0;
foreach ($tariffs->result() as $tariff) {
    echo "Кол-во кВт <input name=tariff[{$i}] > по тарифу {$tariff->tariff_value}<br>";
    echo "<input type=hidden name=tariff_value[{$i}] value='{$tariff->tariff_value}' >";
    $i++;
}
echo "<input type=submit value='Открыть счет на оплату' />";
echo "</form>";
?>