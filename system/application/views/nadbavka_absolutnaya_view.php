<hr>
<h3>Абсолютные надбавки:</h3><br> 
<?php
foreach($nadbavka->result() as $row):
?>
<b>Значение надбавки:</b> 
<?php 
	echo $row->value.'кВт '.' тариф:'.$row->tariff_value;
?>
<?php echo anchor("billing/delete_ab_nadbavka/".$row->id,"<img src=".base_url()."img/delete.png />"); ?>
<br>
<?php endforeach;?>


