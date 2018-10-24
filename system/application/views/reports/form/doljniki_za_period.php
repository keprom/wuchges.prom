<?php echo form_open("billing/doljniki_za_period"); ?>
<select name=period_id>
<?php foreach ($periods->result() as $period):?>
	<option value=<?php echo $period->id;?>><?php echo $period->name;?></option>
<?php endforeach;?>
</select>

<br>Дебиторы кредиторы
<select name=type >
<option value=2 >Выдать дебиторов</option>
<option value=3 >Выдать кредиторов</option>
</select>
<br>

<br>
ТУРЭ :  
<select name=ture_id >
<option value=-1 >Выдать всех</option>
<?php foreach ($ture->result() as $t):?>
	<option value=<?php echo $t->id;?>><?php echo $t->name;?></option>
<?php endforeach;?>
</select>
<br>
<input type=submit value='Выдать отчет' />
</form>
