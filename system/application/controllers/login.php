<?php
class Login extends Controller
{
function red($url,$count=0)
{
	return "<meta http-equiv=\"Refresh\" content=\"$count; URL=".base_url()."index.php/".$url."\">";
	
}

function Login()
{
	parent::Controller();
	
}

function index()
{
	$this->session->unset_userdata('is_login');
	echo $this->red('login/billing');
}
function billing()
{
	$data['logins']=$this->db->get("industry.user");
	$this->load->view('login/billing',$data);
}
function logining()
{	
	$p['id']=$_POST['login'];
	
	$p['password']=md5($_POST['password']);
	$this->db->where($p);
	$this->db->from('industry.user');
	
	if ($this->db->count_all_results()>0)
	{
		$this->db->where($p);
		$this->db->from('industry.user');
		$query=$this->db->get()->row_array();
		
		$this->session->set_userdata($query);		
		$this->session->set_userdata('is_login','TRUE');
		echo $this->red('billing');
		die();
	}
	else
	{
		echo $this->red('login/billing','3');
		echo "<font color=red>������������ ����� ��� ������.</font>";		
		die();
	}
	
	
}

}
?>