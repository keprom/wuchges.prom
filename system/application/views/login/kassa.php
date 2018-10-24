<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

</head>

<body>
<br>
<br>
<br>
<br>
<h2 align=center>Вход в кассу</h2>
<br>
<br>
<br>
<?php echo form_open('kassa/logining');?>
<table align=center valign=bottom>
<tr>
<td>Логин</td>
<td>
<select name=login>
<?php  foreach ($logins->result() as $l) {echo "<option value={$l->id} >{$l->name} {$l->profa}</option>";} ?>
</select >
</td>
</tr>
<tr>
<td>Пароль</td>
<td><input name=password type=password /></td>
</tr>
<tr>
<td></td>
<td><input  type=submit   value='Войти' /></td>
</tr>

</table>
</form>
</div>
</body>