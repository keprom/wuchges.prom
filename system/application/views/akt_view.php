<h3><b>Акты</b></h3><br>

<?php if ($query->num_rows()>0)
{
	foreach($query->result() as $row)
	{
		echo $row->value." кВт по тарифу:" .$row->tariff_value." от ".date("d.m.Y",strtotime($row->data));
		echo anchor("billing/delete_akt/".$row->id,"<img src=".base_url()."img/delete.png />")."<br>";
	}
}
 else
{ 
	echo "Актов за текущий месяц нету";

}
?>
<br>
<hr>
<br>