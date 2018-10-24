<H2>Совместный относительный учет</h2>

<?php  foreach($query->result() as $row ): ?>
<?php  echo "Совместный учет с фирмой <b>".$row->parent_firm_name."</b>
   на точке учета:<b>".$row->billing_point_name."</b>  количество: <b>".$row->sov_value.'%</b>';
 ?>
<?php  echo anchor("billing/delete_sovm_otn/".$row->sov_id,"<img src=".base_url()."img/delete.png />"); ?>
<br>
<?php  endforeach;?>
<br>