<h2> Список номеров счет фактур </h2>
<table border=1 >
<tr><th>Номер </th><th> Период </th></tr>
<?php 
	
	foreach ($numbers->result() as $n)
	{
		echo "<tr><td>{$n->id}</td><td>{$n->period_name}</td></tr>";		  
	}
?>
</table>