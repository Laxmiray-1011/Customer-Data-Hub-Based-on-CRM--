<?php
class Admin_loginmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function admin_login($data)
	{
		$active = 1;
		//$query= $this->db->query("select * from user where user_name='".$data['user_name']."' and user_pass='".$data['user_pass']."' and user_status='".$active."' ");
		$query = $this->db->query("select * from users_details where name='" . $data['name'] . "' and password='" . $data['password'] . "' and status='1' ");
		$get_row_data = $query->row();

		if ($get_row_data != '') {

			return $get_row_data;
		} else {

			return false;
		}
	}
	public function saverecords($cust_data)
	{
		$this->db->insert('customer', $cust_data);
		return $this->db->insert_id();
	}
	public function selectAllData()
	{
		$this->db->select('*');
		$query = $this->db->get('customer');
		return $query->result();
	}

	public function displayrecordsbyid($id)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('c_id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function updaterecords($c_data, $id)
	{

		$this->db->where('c_id', $id);
		if ($this->db->update('customer', $c_data)) {
			return true;
		} else {
			return false;
		}
	}
	public function deletedata($id)
	{
		$this->db->where('c_id', $id);
		if ($this->db->delete('customer')) {
			return true;
		} else {
			return false;
		}
	}
	public function paymentdata($cust_data)
	{
		// echo "<pre>";
		//  print_r($cust_data);
		//  die("something went wrong ");
		$this->db->insert('payment', $cust_data);
		return $this->db->insert_id();
	}

	public function selectpayment_data($id)
	{
		// echo "<pre>";
		// print_r($id);
		// die("something went wrong ");
		// $customer_id = $id;
		$this->db->select('*');
		$this->db->where('customer_id', $id);
		$query = $this->db->get('payment');
		return $query->result();
	}


	// `billerid`, `customer_id`, `lastbilldue`,`previousdue`, `billdate`, `billnumber`, `billamt`, `totalpay`, `billdesc`, `billdue`, `totaldue

	public function get_last_billdue($id)
	{

		// echo "<pre>";
		//    print_r($id);
		//   die("something went wrong1111 ");
		$this->db->select("lastbilldue,billamt,totalpay,billdue");
		//$this->db->from('payment');
		$this->db->where('customer_id', $id);
		//$this->db->order_by('payment_id', 'DESC');
		//$this->db->limit('1');
		$query = $this->db->get('payment');

		return $query->result();
	}

	public function get_by_id($data1)
	{
		// $this->db->from($table);
		$this->db->where('c_id', $data1);
		$query = $this->db->get('customer');


		return $query->row();
	}


	public function get_by_id_name($id)
	{
		// echo"<pre>";
		// print_r($id);
		// die("working here");

		// $this->db->from($table);
		$this->db->where('c_id', $id);
		$query = $this->db->get('customer');
		

		return $query->row();
	}

	public function displaypaymentrecordsbyid($id)
	{
		$this->db->select('*');
		$this->db->from('payment');
		$this->db->where('billerid', $id);
		$query = $this->db->get();
		return $query->result();


	}
	public function get_editlast_billdue($id)
	{
		
	
			// echo "<pre>";
			//    print_r($data);
			//   die("something went wrong1111 ");
			$this->db->select("lastbilldue,billamt,totalpay,billdue");
			$this->db->from('payment');
			$this->db->where('billerid', $id);
			//$this->db->order_by('payment_id', 'DESC');
			//$this->db->limit('1');
			$query = $this->db->get();
	
			return $query->result();
		
	
	}

	public function update_paymentrecords($Payment_data,$id)
	{
		$this->db->where('billerid', $id);
		if ($this->db->update('payment', $Payment_data)) {
			return true;
		} else {
			return false;
		}
	}


	public function deletepaymentdata($id)
	{
		$this->db->where('billerid', $id);
		if ($this->db->delete('payment')) {
			return true;
		} else {
			return false;
		}
	}





	public function deletedc_id($id)
	{
		$this->db->select('customer_id');
		$this->db->from('payment');
		$this->db->where('billerid', $id);
		$query = $this->db->get();
		return $query->result();


	}
	

	public function save($data)
	{
		$query =$this->db->insert('customer_data', $data);
		return $query;
	}
	// function get_datatables($where)
	// {
	// 	$this->_get_datatables_query($where);
	// 	if($_POST['length'] != -1)
	// 	$this->db->limit($_POST['length'], $_POST['start']);
	// 	$query = $this->db->get();
	// $query = $this->db->insert('person',$data);
	// 	return $query;
	// 	return $query->result();
	// }

}
