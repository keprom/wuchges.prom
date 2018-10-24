<?php 

 
 
 if ($this->session->flashdata('is_changed')=='изменено')
 {
	echo "<b>Данные успешно изменены</b>";
 }
 
?>

<h2>Изменение данных по организации</h2>
<?php echo form_open("billing/changing_org_info"); ?>
Наименование организации <input name=org_name value='<?php echo $org_info->org_name;?>'><br>
РНН организации <input name=rnn value='<?php echo $org_info->rnn;?>'><br>
ИИК организации <input name=IIK value='<?php echo $org_info->IIK;?>'><br>
Адрес организации <input name=address value='<?php echo $org_info->address;?>'><br>
Телефон <input name=telefon value='<?php echo $org_info->telefon;?>'><br>
Банк <input name=bank_name value='<?php echo $org_info->bank_name;?>'><br>
БИК организации <input name=bank_bik value='<?php echo $org_info->bank_bik;?>'><br>
КБЕ организации <input name=Bank_kbe value='<?php echo $org_info->Bank_kbe;?>'><br>
КНП организации <input name=bank_knp value='<?php echo $org_info->bank_knp;?>'><br>
Директор <input name=director value='<?php echo $org_info->director;?>'><br>
Главный бухгалтер <input name=glav_buh value='<?php echo $org_info->glav_buh;?>'><br>
Начальник отдела сбыта <input name=nachalnik_otdela_sbyta value='<?php echo $org_info->nachalnik_otdela_sbyta;?>'><br>
Cвидетельство о ндс <input name=svidetelstvo_nds value='<?php echo $org_info->svidetelstvo_nds;?>'><br>
<br/><br/>
<input type=submit value="Обновить данные" />
</form>
