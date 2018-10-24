<H2>Совместный учет путем полного вычета</h2>

<?php  foreach($query->result() as $row ): ?>
<?php  echo "Совместный учет с фирмой <b>".$row->firm_name."</b>";
 ?>
<?php  echo anchor("billing/delete_sovm_by_counter/".$row->sov_id,"<img src=".base_url()."img/delete.png />"); ?>
<br>
<?php  endforeach;?>
<br>