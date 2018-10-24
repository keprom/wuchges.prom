<?php
class Kassa2 extends Controller
{
	function index()
	{
		$this->load->view("kassa2/view");
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
		
		$this->load->view("kassa2/add_oplata",$data);
	}
	function adding_oplata()
	{
		$this->session->set_userdata(array('kassa_data2'=>$_POST['data']));
		$this->db->insert('kassa.oplata2',$_POST);
		redirect('kassa2/index');
	}
	function view_oplata()
	{
		$data['data']=$_POST['data'];
		$this->db->where ('data',$_POST['data']);
		$data['oplata']=$this->db->get('kassa.oplata_view2');
		$this->load->view('kassa2/oplata_list',$data);
	}
	
	function delete_oplata()
	{
		$this->db->where('id',$this->uri->segment(3));
		$this->db->delete('kassa.oplata2');
		redirect('kassa2/index');
	}
	
}

?>