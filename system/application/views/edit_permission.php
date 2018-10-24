<?php echo form_open('billing/edition_permission');?>
<input type='hidden' name=id value=<?php echo $perm['id'];?>>
Имя пользователя <input name=name value='<?php echo $perm['name'];?>' size=75> </input>
<br>
<br>
Логин пользователя <input name=login value='<?php echo $perm['login'];?>' size=75> </input><br>
<br>
<br>
Логин пользователя <input name=profa value='<?php echo $perm['profa'];?>' size=75> </input><br>
<br>
<br>
Имеет ли возможность работать пользователь <input type=checkbox name=login <?php 
if ($perm['enabled']!='t') echo 'checked'; ?>> <br><br>

<?php foreach($perm as $key=>$value):?>
<?php if (($key!='id')and($key!='name')and($key!='login')and($key!='password')and($key!='enabled')and($key!='profa')): ?>
<?php echo $key;?> <input type=checkbox name="<?php echo $key;?>" <?php  if ($value=='t') echo "checked"; ?> />
<br>
<br>
<?php endif; ?>
<?php endforeach;?>
<br>
<br>
<input type=submit value='Обновить данные' >

</form>