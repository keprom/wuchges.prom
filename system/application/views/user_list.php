<h2> Список пользователей </h2>
<table>
<tr><th>Имя пользователя </th><th> Профессия </th><th> Логин </th><th> Редактирование </th></tr>
<?php 
	
	foreach ($users->result() as $user)
	{
		echo "<tr><td>{$user->name}</td><td>{$user->profa}</td><td>{$user->login}</td><td>".anchor("billing/edit_permission/".$user->id,"редактировать")."</td></tr>";		
	}
?>
</table>