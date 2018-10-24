<html>
<head>
<title>Отчет по дебиторам и кредиторам</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<center>
<b>Отчет по дебиторам и кредиторам по КГЭС (юридические лица)</b>
<br />
<br />
<br />
<?php echo form_open("doljniki_control/otchet"); ?>
<b>Выберите период: </b>
<select name=period_id>
<?php foreach ($periods->result() as $period):?>
	<option value=<?php echo $period->id;?>><?php echo $period->name;?></option>
<?php endforeach;?>
</select>

<br><b>Дебиторы кредиторы: </b>
<select name=type >
<option value=1 >Выдать всех</option>
<option value=2 >Выдать дебиторов</option>
<option value=3 >Выдать кредиторов</option>
</select>
<br>

<br>
<input type=submit value='Выдать отчет' />
</form>
<center>
</html>