<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends CI_Controller {
	
	var $tbl_subject="subject";

	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');	 
		$this->load->library('session');
		$this->load->library('encrypt');
	  
		$this->load->model('person_model','person');
		$this->load->model('person_model_subject','subject_model');
		$this->load->model('Subject_list_model');
		$this->load->database();
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('person_view');
	}
	
	public function customer_trash()
	{
		$this->load->helper('url');
		$this->load->view('person_view_trash');
	}

	public function ajax_list()
	{
		$where = array();
		$where['course_status'] = "";
		
		$list = $this->person->get_datatables($where);		
		$data = array();
		$no = $_POST['start'];
		
		
		  /*   [15] => stdClass Object
        (
            [course_id] => 745
            [course_name] => birendralal
            [course_description] => 9938634056
            [meta_title] => 
            [meta_description] => chilima sambalur odisa india
            [meta_keyword] => cd dlx nm
            [course_status] => Active
            [course_registration] => 0000-00-00
        ) */
		/*  echo "<pre>";
		print_r($list);
		die('rakesh');  */
		foreach ($list as $person) {
			$no++;
			$row = array();
			
			$row[] = $person->course_id;
			$row[] = '<a href="javascript:void(0)" style="width:100px;" title="User Name" >'.$person->course_name;'</a>';
			$row[] = $person->course_description;
			//$row[] = $person->meta_title;
			$row[] = $person->meta_description;
			$row[] = $person->meta_keyword;
			
			$balance = $this->last_bill_due_cus($person->course_id);			
			$row[] = $balance['lastbilldue'];
			
			//add html for action
			$row[] = '<a style="width:55px;" class="btn btn-sm btn-primary" href="javascript:void(0)" title="View"  onclick="view_subject_list('."'".$person->course_id."'".')"><i class="glyphicon glyphicon-plus"></i>Add</a>
			<a style="width:55px;" class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->course_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a style="width:65px;" class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->course_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}
		/* echo "<pre>";
print_r($data);
		die('rakesh'); */
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->person->count_all($where),
						"recordsFiltered" => $this->person->count_filtered($where),
						"data" => $data,
				);
				
		echo json_encode($output);
	}
	public function view_course_list(){
		
		
		$this->load->view('subject_view_list');
	
	}
	
	public function course_name(){
		
		
		$where['course_id'] = $this->input->post('id');
		$table1="course";
		$data = $this->Subject_list_model->get_by_id($table1,$where);
		print_r($data->course_name);
	}
	
	public function view_course_list_data($id){
		
			
		
		$table ="payment";
		//Full texts 	payment_id 	billerid 	lastbilldue 	billnumber 	billamount 	totalpayment 	balancedue 	billdescription 	billdate 	regdate 	status
		$column_order =  array('billnumber','lastbilldue','billamount','totalpayment','balancedue','billdescription','billdate','regdate','status'); //set column field database for datatable orderable
		$column_search = array('billnumber','lastbilldue','billamount','totalpayment','balancedue','billdescription','billdate','regdate','status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
		$order = array('payment_id' => 'asc'); // default order
		$where_condation = array();
		$where_condation["billerid"] = $id;

		$list = $this->Subject_list_model->get_datatables($table,$column_order,$column_search,$order,$where_condation);
		//var_dump($list);die();
		$data = array();	
		/* echo "<pre>";
		print_r($list);
		die("111"); */
		//$list = $this->Subject_list_model->get_datatables($id);		
		$no = $_POST['start'];	



		$total_balance = 0;	
		//echo "<pre>"; 
		//print_r($list);die();
		foreach ($list as $person) {
			
			$no++;			
			$row = array();			 
			
			//------------------------------------
			
			$totalpayment = $person->totalpayment;
			$billamount = $person->billamount;
			//$date=date_create("2013-03-15");
			/* $billdate = date_format($person->billdate,"Y/m/d H:i:s");
			echo "<pre>";
			print_r($billdate);die('123456'); */

			$regdate = date("d M y g:i", strtotime($person->regdate));
			$row[] = $regdate;

			$billdate = date("d M y", strtotime($person->billdate));
			$row[] = $billdate;		
			$row[] = "Invoice Nu: ".$person->billnumber.'</br>Description: '.$person->billdescription;

			//$row[] = $person->billnumber;	

			//$row[] = $person->totalpayment; transparent	 
			//$row[] = $person->billamount;
			$row[] = '<p  style = "height:30px;width: 100px;border-style: double;border-color: green green green green;text-align:center;">Rs.'.$person->totalpayment.'</p>
			<p style ="height:30px;width: 100px;border-style: double;border-color: transparent transparent transparent transparent;text-align:center;"></p>';


			$row[] = '<p  style = "height:30px;width: 100px;border-style: double;border-color: transparent transparent transparent transparent;text-align:center;"></p>
			<p style ="height:30px;width: 100px;border-style: double;border-color: red red red red;text-align:center;">Rs.'.$person->billamount.'</p>';


			
			//echo "</br>";
			//echo 
			$totalpayment = $person->totalpayment + 0;
			//echo "</br>";
			//echo 
			$billamount = $person->billamount + 0;
			//echo "</br>";
			//echo 
			$balance = $billamount - $totalpayment; 
			//echo "</br>";
			//echo 
			$total_balance = $balance + $total_balance;
			//echo "</br>";
			

			$row[] = '<p  style = "height:30px;width: 100px;border-style: double;border-color: transparent transparent transparent transparent;text-align:center;"></p>
			<p  style = "height:30px;width: 100px;border-style: double;border-color: #5cb85c #5cb85c #5cb85c #5cb85c;text-align:center;background-color:#292b2c ;color: white;"><b>Rs.'.$total_balance.'</b></p>';


			//$row[] = $person->billamount;
			
			
			//$row[] = $person->lastbilldue;
						
			//$row[] = $person->billdate;
			//$row[] = $person->regdate; 


			
			//add html for action
			if($person->status =='Active'){
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_subject('."'".$person->payment_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_subject('."'".$person->payment_id."'".')"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
		
			}else{
			$row[] = '<a class="btn btn-sm btn-primary"  href="javascript:void(0)" title="Edit" onclick="edit_subject('."'".$person->payment_id."'".')"><i class="glyphicon glyphicon-pencil"></i>Undo</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_subject('."'".$person->payment_id."'".')"><i class="glyphicon glyphicon-trash"></i>Delete</a>';
			}
			
			
			
			
			//$data[] ='<a class="btn btn-sm btn-primary">'".$row."'</a>';
			$data[] = $row;

			//print_r($data);
			//echo "<pre>";
			//print_r($data);
			//echo "<br>";
			//echo "Rakeshdie";
		}
		
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Subject_list_model->count_all($table,$where_condation),
						"recordsFiltered" => $this->Subject_list_model->count_filtered($table,$column_order,$column_search,$order,$where_condation),
						"data" => $data,
				);			
			
			//die("rakesh ties");
		echo json_encode($output);
	}
	
	public function subject_list()
	{
	
		
		$list = $this->subject_model->get_datatables();	
	
		$data = array();
		$no = $_POST['start'];
		//Full texts 	subject_id 	course_id 	subject_name 	subject_description 	meta_title 	meta_description 	meta_keyword 	status
		foreach ($list as $person) {
			$no++;
			$row = array();
			
			$course = $this->person->get_by_id($person->course_id);
			//print_r($course->course_name);die('t');
			
			$row[] = $course->course_name;
			
			$row[] = $person->subject_name;
			
			$row[] = $person->subject_description;
			
			$row[] = $person->meta_title;
			
			$row[] = $person->meta_description;
			
			$row[] = $person->meta_keyword;
			
			if($person->status == 1){
				$row[] = "Active";
			}else{
				$row[] = "In Active";
				
			}
			//$row[] = $person->status;
			
			
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_subject('."'".$person->subject_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_subject('."'".$person->subject_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->subject_model->count_all(),
						"recordsFiltered" => $this->subject_model->count_filtered(),
						"data" => $data,
				);
					
				
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		
		$data = $this->person->get_by_id($id);		
		echo json_encode($data);
		
	}

	public function purchase_user() 
	{
		
		$data = $this->person->purchase_user_name();		
		echo json_encode($data);
		
	}


	
	public function ajax_edit_subject($id)
	{
		
		$data = $this->subject_model->get_by_id($id);		
		echo json_encode($data);
		
	}
	
	public function ajax_get_course(){
		$query = $this->db->query("select course_id,course_name from course");
		//$query = $this->db->get('course');
			$data = $query->result_array();			
			echo json_encode($data);
		
	}

	public function view_subject(){
		
		$this->load->view('subject_view');
		
	}

	public function register_view(){
		
		$this->load->view('register_view');
		
	}
	
	public function ajax_add()
	{
			
		
			
			$data = array(
				'course_name' => $this->input->post('coursename'),
				'course_description' => $this->input->post('coursedescription'),
				'meta_title' => $this->input->post('metatitle'),
				'meta_description' => $this->input->post('metadescription'),
				'meta_keyword' => $this->input->post('metakeyword'),
				'course_status' => "",
				'course_registration' => $this->input->post('dob'),				
			);
			
			
			$insert = $this->person->save($data);
			echo json_encode(array("status" => TRUE));
			
	}
	
	public function ajax_subject_add()
	{
//course_id 	subject_name 	subject_description 	meta_title 	meta_description 	meta_keyword 	status
		
  
   $regdate =  date("Y-m-d h:i:s");
   
   
   $billamount = $this->input->post('billamount');
   $totalpayment = $this->input->post('totalpayment');
   $lastbilldue = $billamount - $totalpayment;
			
			$data = array(
				'billerid' => $this->input->post('id'),
				'lastbilldue' => $lastbilldue,
				'billnumber' => $this->input->post('billnumber'),
				'billamount' => $this->input->post('billamount'),
				'totalpayment' => $this->input->post('totalpayment'),				
				'billdescription' => $this->input->post('billdescription'),
				'billdate' => $this->input->post('billdate'),				
				'regdate' =>$regdate			
			);
			//'balancedue' => $this->input->post('balancedue'),
			
//payment_id 	billerid 	lastbilldue 	billnumber 	billamount 	totalpayment 
			//balancedue 	billdescription 	billdate 	regdate 	status
	
		//	print_r($data);exit();
		$insert = $this->subject_model->save($data);
		echo json_encode(array("status" => TRUE));
	}
	
	

	public function ajax_update()
	{
		
			$data = array(
				'course_name' => $this->input->post('coursename'),
				'course_description' => $this->input->post('coursedescription'),
				'meta_title' => $this->input->post('metatitle'),
				'meta_description' => $this->input->post('metadescription'),
				'meta_keyword' => $this->input->post('metakeyword'),
				'course_status' => $this->input->post('status'),
				'course_registration' => $this->input->post('dob'),
				
			);
			
		$this->person->update(array('course_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_subject_update()
	{	

 
   $billamount = $this->input->post('billamount');
   $totalpayment = $this->input->post('totalpayment');
   $lastbilldue = $billamount - $totalpayment;
		
			//'billerid' => $this->input->post('id'),
			$data = array(				
				'lastbilldue' => $lastbilldue,
				'billnumber' => $this->input->post('billnumber'),
				'billamount' => $this->input->post('billamount'),
				'totalpayment' => $this->input->post('totalpayment'),
				'balancedue' => $this->input->post('balancedue'),
				'billdescription' => $this->input->post('billdescription'),
				'billdate' => $this->input->post('billdate')											
			);
			
			
			//payment_id 	billerid 	lastbilldue 	billnumber 	billamount 	totalpayment 
			//balancedue 	billdescription 	billdate 	regdate 	status
	
			$this->subject_model->update(array('payment_id' => $this->input->post('id')), $data);	
			//$insert = $this->subject_model->save($data);
			echo json_encode(array("status" => TRUE));
		
	}

	public function last_bill_due($id){
		
		$data = $this->subject_model->get_last_billdue($id);

		$billamount_sum = 0;
		$totalpayment_sum = 0;
		/* echo "<pre>";

print_r($data);die('test1111');	 */	
		
		foreach ($data as &$value) {
			
			 $billamount = $value['billamount'];			 
			 $billamount_sum = $billamount_sum + $billamount;			
			 $totalpayment = $value['totalpayment'];
			 $totalpayment_sum = $totalpayment_sum + $totalpayment;
			 }
			
			$balance_due['lastbilldue'] = $billamount_sum - $totalpayment_sum;
			$balance_due['billamount_sum'] = $billamount_sum;
			$balance_due['totalpayment_sum'] = $totalpayment_sum;
			
			
			 
		echo json_encode($balance_due);
	}
	
	public function last_bill_due_cus($id){
		
		$data = $this->subject_model->get_last_billdue($id);
		/* echo "<pre>";
		print_r($data);die('rakesh'); */
		$billamount_sum = 0;
		$totalpayment_sum = 0;		
		/*  Array
(
    [0] => Array
        (
            [lastbilldue] => 4411
            [billamount] => 5645
            [totalpayment] => 1234
            [balancedue] => 
        )
) */
		
	 	foreach ($data as &$value) {
			
			 $billamount = $value['billamount'];			 
			 $billamount_sum = $billamount_sum + $billamount;			
			 $totalpayment = $value['totalpayment'];
			 $totalpayment_sum = $totalpayment_sum + $totalpayment;
			 }
			
			$balance_due['lastbilldue'] = $billamount_sum - $totalpayment_sum;
			$balance_due['billamount_sum'] = $billamount_sum;
			$balance_due['totalpayment_sum'] = $totalpayment_sum; 
		
		//$balance_due=000;	
		
		return $balance_due;
	}
	
	public function ajax_delete($id)
	{
		$this->person->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_subject_delete($id)
	{
		$this->subject_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
