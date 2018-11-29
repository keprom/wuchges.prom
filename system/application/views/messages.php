<?php
$error = $this->session->flashdata('error');
$warning = $this->session->flashdata('warning');
$success = $this->session->flashdata('success');
?>
<?php if ($error != false): ?>
    <?php foreach ($error as $m): ?>
        <a href="#" onclick="this" style="color: #FF0000;"><?php echo $m; ?></a><br><br>
    <?php endforeach; ?>
<?php endif; ?>
<?php if ($warning != false): ?>
    <?php foreach ($warning as $m): ?>
        <a href="#" onclick="this" style="color: #FFFF00;"><?php echo $m; ?></a><br><br>
    <?php endforeach; ?>
<?php endif; ?>
<?php if ($success != false): ?>
    <?php foreach ($success as $m): ?>
        <a href="#" onclick="this" style="color: #00CC00;"><?php echo $m; ?></a><br><br>
    <?php endforeach; ?>
<?php endif; ?>
