<?php
class Doljniki_control extends Controller
{
	function index()
	{
		$sql="SELECT * from industry.period order by id";
		$data['periods']=$this->db->query($sql);
		$this->load->view("doljniki/preview",$data);
		}
	
	function otchet()
	{	Set_Time_Limit(0);
		$data['org_info']=$this->db->get("industry.org_info")->row();
		$sql='select * from industry.period where id='.$_POST['period_id'];
		$data['period']=$this->db->query($sql)->row();
		$sql='select * from industry."7-re" where period_id='.$_POST['period_id'];
		$data['otchet_name']="по дебиторам и кредиторам ";
		if ($_POST['type']==2){
			$sql.=" and 
			coalesce(\"7-re\".debet_value,0) - 
			coalesce(\"7-re\".kredit_value,0)	+
			coalesce(\"7-re\".nachisleno,0) -
			coalesce(\"7-re\".oplata_value,0)>0 ";
			$data['otchet_name']="по дебиторам ";
			}
		if ($_POST['type']==3){
			$sql.=" and 
			coalesce(\"7-re\".debet_value,0) - 
			coalesce(\"7-re\".kredit_value,0)	+
			coalesce(\"7-re\".nachisleno,0) -
			coalesce(\"7-re\".oplata_value,0)<0 ";
			$data['otchet_name']="по кредиторам ";
			}
		$data['result']=$this->db->query($sql);	
		$this->load->view("doljniki/vih_otchet",$data);
	}
	
}

?>