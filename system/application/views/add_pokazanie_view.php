<H3>Добавление показания</H3>

<?php
echo form_open("billing/adding_pokazanie");
?>
<h5>Показание</h5>
<input type="text" name="value" value="" size="50" />
<h5>Дата взятия показания</h5>
День <input type="text" name="day" value="<?php echo $this->session->userdata('day');?>" size="5" />
Месяц <input type="text" name="month" value="<?php echo $this->session->userdata('month');?>" size="5" />
Год <input type="text" name="year" value="<?php echo $this->session->userdata('year');?>" size="5" />
<input type=hidden name=values_set_id value="<?php echo $set_id; ?>" />
<input type=hidden name=nds value="12" />
<br><br><br>
<input type='submit' value='добавить показание'/>
</form>
