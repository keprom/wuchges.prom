<table>
<tr>
<td>

<?php 
$attr=array('target'=>'oplata_view');
echo form_open('billing/oplata_view',$attr); ?>

Договор <input name=dogovor ><br>
Сумма <input name=oplata_value ><br>

 <input type=submit value='Добавить оплату' >
</form>

</td>
<td>

<?php 
$attr=array('target'=>'oplata_view');
echo form_open('billing/oplata_view',$attr); ?>

Стартовая дата <input name=start_date ><br>
Конечная дата <input name=finish_date ><br>

 <input type=submit value='Вывести оплату' >
</form>
 
</td>
</tr>
</table>