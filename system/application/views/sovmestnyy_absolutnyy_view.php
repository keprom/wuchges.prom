<H2>Совместный относительный учет</h2>

<?php foreach ($query->result() as $row): ?>
    <?php echo "Совместный абсолютный учет с фирмой <b>" . $row->firm_name . "</b><br>
     количество: <b>" . $row->value . '%</b>';
    ?>
    <?php echo anchor("billing/delete_sovm_ab/" . $row->id, "<img src=" . base_url() . "img/delete.png />"); ?>
    <br>
<?php endforeach; ?>
<br>