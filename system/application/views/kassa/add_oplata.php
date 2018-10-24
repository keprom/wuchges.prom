<?php 
function select($var,$name,$value)
{
	$string="<select name={$name}_id>";
	foreach ($var->result() as $v) 
	{
		$string.="<option value={$v->id} ".($v->id==$value?" selected ":"")." >{$v->name}</option>";
	}
	$string.="</select><br>";
	echo $string;
}
?>
<html>
<head>
<title>Добавление оплаты</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<body>
<br />
<br />
<center>
<h2>Добавление оплаты по абонентскому номеру</h2>
<br />

<?php echo form_open("kassa/adding_oplata");?>
Сумма оплаты <input name="value" /><br/><br/>
Дата оплаты <input name="data" value='<?php echo $this->session->userdata('kassa_data'); ?>' ><br/><br/>
Абонентский номер 
<input name="number" value="<?php echo $abonent_number;?>"> <br/><br/>
<?php
  if ($abonent==NULL)
  {
	echo "Фамилия имя отчество <input name=fio /><br /><br />Улица <select name='street_id' >";
	foreach($street->result() as $s)
	{
		echo "<option value='{$s->id}'>{$s->name}</option>";
	}
	echo "</select><br><br>";
	echo "Дом <input name=dom /><br /><br />Квартира <input name=kv /><br /><br />";
  }
  else
  {
	$ab=$abonent->row();
	echo "Фамилия имя отчество <input name=fio value='".$ab->fio."'/><br /><br />";
	echo "Улица <select name='street_id' >"; 
	foreach($street->result() as $s)
	{
		echo "<option ".($s->id==$ab->street_id?" selected ":"")." value={$s->id}  >".trim($s->name)."</option>";
	}
	echo "</select><br><br>";
	echo "Дом <input name=dom value={$ab->dom} /><br /><br />Квартира <input name=kv value={$ab->kv} /><br /><br />";
	
  }
  ?>
  <br /><br />
<input type=submit value='Открыть по абонентскому номеру' />
</form>
</center>
</body>