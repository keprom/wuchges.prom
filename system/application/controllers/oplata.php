<?php
class Oplata extends Controller
{

	function datetostring($date)
	{
		$d=explode("-",$date); 
		return $d['2'].'.'.$d['1'].'.'.$d['0'];
	}
	
	function Oplata()
	{
		parent::Controller();
		
	}
	function index()
	{
		$sql="select * from industry.oplata_edit where data between '01.01.10' and '31.01.10'";
		$data['oplata']=$this->db->query($sql);
		$this->load->view('oplata/index',$data);
	}
	function adding_oplata()
	{
//	(($this->session->userdata('billing/'.$function)=='t') 
//(($this->session->userdata('billing/'.$function)=='t') 
//$this->session->set_userdata(array('day'=>$_POST['day'],'month'=>$_POST['month'],'year'=>$_POST['year']));


		$sql="select count(*) from industry.firm where dogovor=".$_POST['dogovor'];
		$count=$this->db->query($sql)->row()->count;
		
		$sql="select id from industry.firm where dogovor=".$_POST['dogovor'];
		$query=$this->db->query($sql);
		if ($count>0)
		{
			$firm_id=$this->db->query($sql)->row()->id;
			$data['firm_id']=$firm_id;
			$data['nds']=$_POST['nds'];
			$sql="select count(*)  from industry.payment_number where number='".$_POST['payment_number']."'";
			$count=$this->db->query($sql)->row()->count;
			$sql="select id from industry.payment_number where number='".$_POST['payment_number']."'";
			echo $sql;
			$query=$this->db->query($sql);
			if ($count>0)
			{
				$data['payment_number_id']=$query->row()->id;
				$this->session->set_userdata(
					array( 	'data'			=>	$_POST['data'],
						'number'	=>	$_POST['payment_number']
					        ) 
				);
				$data['value']=$_POST['value']/1.12;
				$data['data']=$_POST['data'];
				$this->db->insert('industry.oplata',$data);

			}
		}
		redirect('oplata');
	}
	function delete()
	{
		$sql="delete from industry.oplata where id=".$this->uri->segment(3);
		$this->db->query($sql);
		redirect('oplata');
	}
	
}

?>