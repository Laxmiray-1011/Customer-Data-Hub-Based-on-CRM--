<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Autocontroller extends CI_Controller
{
	function __construct()
	{

		parent::__construct();
		$this->load->helper(array('form', 'url', 'date'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Admin_loginmodel');
		$this->load->library('encrypt');
	}

	public function index()
	{

		$this->load->view('Admin_login');
	}
	public function get_form_data()
	{
		$get_user_name = $this->input->post('user_name');
		$get_user_pass = $this->input->post('user_pass');
		$this->form_validation->set_rules('user_name', 'User', 'required');
		$this->form_validation->set_rules('user_pass', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {

			$data = array();
			$data['name'] = $get_user_name;
			$data['password'] = $get_user_pass;
			$return_login_data = $this->Admin_loginmodel->admin_login($data);

			if ($return_login_data == false) {
				$data['error'] = "Invalid User Details";
				$this->load->view('Admin_login', $data);
			} else {
				$this->session->set_userdata('user_data', $return_login_data);

				$this->load->helper('url');
				redirect('Autocontroller/dashboard', 'refresh');
			}
		}
	}
	public function dashboard()
	{

		$data['contentdata'] = $this->Admin_loginmodel->selectAllData();
		$this->load->view("dashboard", $data);
		// $this->load->view('dashboard');
	}
	public function add_customer()
	{
		$this->load->view('Add_Customer');

		//$this->load->view('');
	}

	public function register()
	{

		$this->form_validation->set_rules('Name', 'c_name', 'trim|required');
		$this->form_validation->set_rules('phone', 'c_phone', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('email', 'c_email', 'trim|required|valid_email|is_unique[customer.c_email]');
		$this->form_validation->set_rules('description', 'c_desc', 'trim|required');
		$this->form_validation->set_rules('address', 'c_addr', 'trim|required');
		$this->form_validation->set_rules('date', 'c_regdate', 'trim|required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');



		if ($this->form_validation->run() == false) {

			$this->load->view('Customer_register');
		} else {

			$cust_data = array(
				'c_name' => $this->input->post('Name', TRUE),
				'c_phone' => $this->input->post('phone', TRUE),
				'c_email' => $this->input->post('email', TRUE),
				'c_desc' => $this->input->post('description', TRUE),
				'c_addr' => $this->input->post('address', TRUE),
				'c_regdate' => $this->input->post('date', TRUE)
			);
			// echo "<pre>";
			//        print_r($cust_data);
			// 	   die("something went wrong");

			if ($this->Admin_loginmodel->saverecords($cust_data)) {
				//  echo "insert data successfull";
				// echo "<script>alert('Data inserted Successfully')</script>";
				redirect("Autocontroller/dashboard");
			} else {
				echo "not inserted";
			}
		}
	}

	public function updatedata()
	{
		$id = $this->input->get('ep');
		//  echo $id;
		//  die(" not working from here");
		$data['contentdata'] = $this->Admin_loginmodel->displayrecordsbyid($id);
		//  echo "<pre>";
		//  print_r($data);
		//  die(" not working from here");
		$this->load->view('Customer_edit', $data);
		if ($this->input->post('submit')) {
			$name = $this->input->post('Name');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$desc = $this->input->post('description');
			$addr = $this->input->post('address');
			$date = $this->input->post('date');
			//  echo $name,$phone,$email,$desc,$addr,$date;
			$c_data = array("c_name" => $name, "c_phone" => $phone, "c_email" => $email, "c_desc" => $desc, "c_addr" => $addr, "c_regdate" => $date);
			if ($this->Admin_loginmodel->updaterecords($c_data, $id)) {
				// echo "updatted successfully";
				// echo "<script>alert('Data updatted Successfully')</script>";
				redirect("Autocontroller/dashboard");
			} else {
				echo "<script>alert('Data not updatted Successfully')</script>";
			}
		}
	}
	public function deletedata()
	{
		$id = $this->input->get('del');
		// echo $id;
		if ($this->Admin_loginmodel->deletedata($id)) {
			// echo "data is delete";
			// echo "<script>alert('Data Deleted Successfully')</script>";
			redirect("Autocontroller/dashboard");
		} else {
			echo "not delete";
		}
	}

	public function cutomer_view()
	{

		$this->load->view('Customer_List');
	}

	public function customer_paymentview_list()
	{
		$id = $this->input->get('pay');
		// echo"<pre>";
		// print_r($id);
		// die("working here");

		$data1 = $this->Admin_loginmodel->get_by_id_name($id);

		// echo"<pre>";
		// print_r($data1);
		// die("working here");


		$datas['customerdata'] = $this->Admin_loginmodel->selectpayment_data($id);
		//  echo "<pre>";
		//  print_r($data1);
		//   print_r($datas);                     

		//   die("testing");
		$datas['customername'] = $data1->c_name;

		$this->load->view('Customer_List', $datas);
	}




	public function add_payment()
	{
		$data['customer_id'] = $this->input->get('pay');
		// $table1="customer";
		$data1 = $this->Admin_loginmodel->get_by_id($data['customer_id']);
		// echo "<pre>";
		// print_r($data1->c_name);

		// die("Hello");
		$data['payment_data'] = $this->Admin_loginmodel->get_last_billdue($data['customer_id']);



		$billamount_sum = 0;
		$totalpayment_sum = 0;



		//  [0] => stdClass Object
		//         (
		//             [lastbilldue] => 
		//             [billamt] => 5000
		//             [totalpay] => 1000
		//             [billdue] => 000
		//         )

		foreach ($data['payment_data'] as $value) {
			$billamountt = $value->billamt;
			$billamount_sum = $billamount_sum + $billamountt;
			$totalpayment = $value->totalpay;
			$totalpayment_sum = $totalpayment_sum + $totalpayment;
		}

		$balance_due['lastbilldue'] = $billamount_sum - $totalpayment_sum;
		$balance_due['billamount_sum'] = $billamount_sum;
		$balance_due['totalpayment_sum'] = $totalpayment_sum;
		$balance_due['customer_id'] = $data['customer_id'];
		$balance_due['customer_name'] = $data1->c_name;


		//echo json_encode($balance_due);

		// redirect("Autocontroller/customer_view_list?pay=" . $data);


		$this->load->view('Add-payment', $balance_due);
	}

	public function paymentform_submit()
	{




		if ($this->input->post('submit')) {
			$previousdue = $this->input->post('lastbilldueadd');
			$billdate = $this->input->post('billdate');
			$billnumber = $this->input->post('billnumber');
			$billamt = $this->input->post('billamountadd');
			$totalpay = $this->input->post('totalpaymentadd');
			$billdesc = $this->input->post('billdescription');
			$billdue = $this->input->post('billdueadd');
			$totaldue = $this->input->post('balancedueadd');
			$id = $this->input->post('customer_id');
			// $transectiondate=$this->input->post('transectiondate');
			// echo  $previousdue,$billdate,$billnumber,$billamt,$totalpay,$billdesc,$billdue,$totaldue;

			// `billerid`, `customer_id`, `previousdue`, `billdate`,`transectiondate`, `billnumber`, `billamt`, `totalpay`, `billdesc`, `billdue`, `totaldue`
			// die("lkjhgfdsaqwertyuiop");

			// print_r($id);
			// die("have some user id related issue");
			date_default_timezone_set('Asia/Kolkata');
			$transectiondate = date("Y-m-d h:i:s");

			$cust_data = array("transectiondate" => $transectiondate, "customer_id" => $id, "previousdue" => $previousdue, "billdate" => $billdate, "billnumber" => $billnumber, "billamt" => $billamt, "totalpay" => $totalpay, "billdesc" => $billdesc, "billdue" => $billdue, "totaldue" => $totaldue,);
			if ($this->Admin_loginmodel->paymentdata($cust_data)) {
				//$id = $this->input->get('pay',TRUE);
				//$id = $this->uri->segment('1');
				//  echo $id;
				// print_r($cust_data);
				//  die("have some user id related issue");




				//$url="Autocontroller/customer_view_list?pay=".$id;

				redirect("Autocontroller/customer_paymentview_list?pay=" . $id);
				// $this->customer_view_list();
			} else {
				echo "not inserted";
			}
		}
	}




	public function updatepaymentdata()
	{
		$id = $this->input->get('edit');
		$data['contentpaymentdata'] = $this->Admin_loginmodel->displaypaymentrecordsbyid($id);
		//  echo "<pre>";
		//  print_r($data);
		//  die(" not working from here");
		$data2['editpayment_data'] = $this->Admin_loginmodel->get_editlast_billdue($id);


		// echo "<pre>";
		//   print_r($data2['editpayment_data']);
		//   die(" not working from here");
		$billamount_sum = 0;
		$totalpayment_sum = 0;


		foreach ($data2['editpayment_data'] as $value) {
			$billamountt = $value->billamt;
			$billamount_sum = $billamount_sum + $billamountt;
			$totalpayment = $value->totalpay;
			$totalpayment_sum = $totalpayment_sum + $totalpayment;
		}

		$balance_due['lastbilldue'] = $billamount_sum - $totalpayment_sum;
		$balance_due['billamount_sum'] = $billamount_sum;
		$balance_due['totalpayment_sum'] = $totalpayment_sum;
		$balance_due['contentpaymentdata'] = $data['contentpaymentdata'];
		$balance_due['billerid'] = $id;
		// echo "<pre>";
		// print_r($balance_due);
		// die("jhdfdhgfakdfch");

		$this->load->view('customerlist_edit', $balance_due);

		// echo "<pre>";
		// print_r($balance_due);
		// die("jhdfdhgfakdfch");


	}
	public function editpaymentform()
	{

		if ($this->input->post('submit')) {
			$balance_due = $this->input->post('lastbilldue');
			$billdate = $this->input->post('billdate');
			$billnumber = $this->input->post('billnumber');
			$billamount = $this->input->post('billamountadd');
			$totalpayment = $this->input->post('totalpaymentadd');
			$billdesc = $this->input->post('billdescription');
			$balance_due = $this->input->post('billdueadd');
			$billerid = $this->input->post('billerid');
			$id = $this->input->post('customer_id');
			// $id = $this->input->post('customer_id');
			// $previousdue, $billdate, $billnumber, $totalpayment, $billdesc, $balancedue,	$id;
			// `billerid`, `customer_id`, `lastbilldue`, `previousdue`, `billdate`, `transectiondate`, `billnumber`, `billamt`, `totalpay`, `billdesc`, `billdue`, `totaldue
			$Payment_data = array("billerid" => $billerid, "customer_id" => $id, "lastbilldue" => $balance_due, "billdate" => $billdate, "billnumber" => $billnumber, "billamt" => $billamount, "totalpay" => $totalpayment, "billdesc" => $billdesc, "billdue" => $balance_due);


			if ($this->Admin_loginmodel->update_paymentrecords($Payment_data, $billerid)) {
			
				redirect("Autocontroller/customer_paymentview_list?pay=" . $id);
				
			} else {
				echo "not updated";
			}
		}
	}


	public function deletpaymentdata()
	{
		$id = $this->input->get('delet');
		//    $data=$id->customer_id;
		//    echo $id,$data;
		$data = $this->Admin_loginmodel->deletedc_id($id);

		$customer = ($data[0]->customer_id);
		//  echo"<pre>";
		//   print_r($customer);
		//    die("checking both id is print or not");

		if ($this->Admin_loginmodel->deletepaymentdata($id)) {
			// echo "data deleted successfully";

			redirect("Autocontroller/customer_paymentview_list?pay=" . $customer);
		} else {
			echo "data not deleted successfully";
		}
	}


	public function logout()
	{
		session_unset();
		redirect("Autocontroller/index");
	}


    // from here ajax part is started 

	public function modalview(){ 
		
		$this->load->view("modalview");
	}

	public function ajax_add()
	{
			
			$data = array(
				'customer_name' =>$this->input->post('name'),
				'customer_phn' => $this->input->post('phone'),
				'customer_email' => $this->input->post('email'),
				'customer_description' =>$this->input->post('comments'),
				'customer_addr' =>$this->input->post('address'),
				'customer_registration' => $this->input->post('checkin'),				
			);
			// echo"<pre>";
			// print_r($data);
			// die("testing ");
			
			
			$insert = $this->Autocontroller->save($data);
			echo json_encode($insert);
			// echo "<pre>";
			// print_r($insert);
			// die("testing insert or not");

	}

}
