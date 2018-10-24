<html>
<head>
<title>Отчет по оплате за электроэнергию</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>
<body>
<center>
<?php 
echo form_open("kassa2/view_oplata");
echo "<input name=data value='".$this->session->userdata('kassa_data2')."' ><input type=submit value='Просмотреть текущую оплату' /> </form>";
?>
<br />
<br />
<h2>Добавление оплаты по абонентскому номеру</h2>
<br />
<br />
<br />

<?php echo form_open("kassa2/add_oplata");?>
<input name="number" /> <br/><br/>
<input type=submit value='Открыть по абонентскому номеру' />
</form>
</center>
</body>