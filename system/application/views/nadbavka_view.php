<hr>
<h3>Относительные надбавки:</h3><br> 
<?php
foreach($nadbavka->result() as $row):
?>
<b>Значение надбавки:</b> 
<?php 
	echo $row->value.'%';
?>
<?php echo anchor("billing/delete_ot_nadbavka/".$row->id,"<img src=".base_url()."img/delete.png />"); ?>
<br>
<?php endforeach;?>