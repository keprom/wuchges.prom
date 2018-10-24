ВСЕГО:  
<?php
    echo $query->num_rows()." предприятий<br><br>";
	foreach ($query->result() as $row)
	{
	   echo anchor("billing/firm/".$row->firm_id,
	   
	   ($row->is_closed!=NULL?"<FONT COLOR=\"RED\">":"<FONT COLOR=\"GREEN\">").
	   "{$row->dogovor}   {$row->firm_name}   </FONT><br/>
	   
	   ");
	}
	echo "<br><br><br>".anchor("billing/add_firm","Добавить фирму");
?>
