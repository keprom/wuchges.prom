
<h4>Изменение банка</h4>
<?php echo form_open("billing/edition_bank/".$bank_id); ?>
Название банка 
<input name="name" value="<?php echo $bank->name; ?>" /><br/>
MFO 
<input name="mfo"  value="<?php echo $bank->mfo; ?>" /><br/>
корреспонденский счет 
<input name="korr_account" value="<?php echo $bank->korr_account; ?>" /><br/>
Адрес <input name="address" 
value="<?php echo $bank->address; ?>" /><br/>

<br/><br/>
<input type=submit value="изменить банк" />
</form>
