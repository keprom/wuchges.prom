<?php echo form_open("billing/list_of_firms"); ?>
Для куратора
<select name=user_id >
<option value=-1>Для всех</option>
<?php foreach ($users->result() as $u):?>
	<option value=<?php echo $u->id;?>><?php echo $u->name;?></option>
<?php endforeach;?>
</select>


<br>
<br>
<input type=submit value='Выдать отчет' />
</form>
