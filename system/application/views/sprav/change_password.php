<?php 

 if ($this->session->flashdata('ischanged')=='yes')
 {
	echo "<b>Пароль успешно изменен</b>";
 }
 
 if ($this->session->flashdata('ischanged')=='not_ident')
 {
	echo "<b>Новые пароли не совпадают</b>";
 }
 
 if ($this->session->flashdata('ischanged')=='old_pass_error')
 {
	echo "<b>Введен неправильный старый пароль</b>";
 }
 
?>

<h2>Смена пароля</h2>
<?php echo form_open("billing/changing_password"); ?>
Старый пароль <input name="old_pass" type=password /><br>
Новый пароль <input name="new_pass_1" type=password /><br>
Новый пароль повтор<input name="new_pass_2" type=password /><br>
<br/><br/>
<input type=submit value="Смена пароля" />
</form>
