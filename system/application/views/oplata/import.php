<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<body>
<br>
<br>
<br>
<br>
<h2 align=center>Импорт оплаты</h2>
<br>
<br>
<br>
<?php 
if ($d->num_rows>0)
{
	echo "<h3> Неопознаные номера договоров: ";
	foreach($d->result() as $u) 
	{
		echo $u->dog.", ";
	} 
	echo "</h3>";
}
if ($s->num_rows>0)
{
	echo "<h3> Неопознаные номера счетов: ";
	foreach($s->result() as $u) 
	{
		echo $u->schet.", ";
	} 
	echo "</h3>";
}
?>

<?php echo form_open("billing/oplata_import");?>
<input type=submit value='Обновить  оплату'>
</form>
</div>
</body>