<?php
class Kassa extends Controller
{
	function index()
	{
		$this->load->view("kassa/view");
	}
	function add_oplata()
	{
		$this->db->where("number",$_POST['number']);
		$abonent=$this->db->get("kassa.abonent");
		$data["abonent"]=
			($abonent->num_rows>0?$abonent:NULL);
		$data["abonent_number"]=$_POST['number'];
		
		$this->db->order_by('name');
		$data['street']=$this->db->get("kassa.street");
		
		$this->load->view("kassa/add_oplata",$data);
	}
	function adding_oplata()
	{
		$this->session->set_userdata(array('kassa_data'=>$_POST['data']));
		$this->db->insert('kassa.oplata',$_POST);
		redirect('kassa/index');
	}
	function view_oplata()
	{
		$data['data']=$_POST['data'];
		$this->db->where ('data',$_POST['data']);
		$data['oplata']=$this->db->get('kassa.oplata_view');
		$this->load->view('kassa/oplata_list',$data);
	}
	
	function delete_oplata()
	{
		$this->db->where('id',$this->uri->segment(3));
		$this->db->delete('kassa.oplata');
		redirect('kassa/index');
	}
	
}

?>