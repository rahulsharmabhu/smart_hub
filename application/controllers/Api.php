<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('Api_model');
         $this->load->library('session');
    }

	public function index()
	{
		echo "test";
	}

	public function add_user()
	{
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if($first_name !='' && $email !='' && $password !=''){
			$data = array(
						'first_name'=>$first_name, 
						'last_name'=>$last_name, 
						'email'=>$email,
						'password'=>md5($password),
						'created_at'=>date('Y-m-d')
					);
			$check_email = $this->check_email($email);
			if($check_email){
				$response = array('status'=>1005, 'message'=>'The given email already exists ...');
				echo json_encode($response);exit;
			}
			
			$table ='users';
			$result = $this->Api_model->insert_entry($table, $data);
			if($result){
				$response = array('status'=>1000, 'message'=>'Successfully Add Users ...');
			}else{
				$response = array('status'=>1003, 'message'=>'Server Error ...');	
			}
		}
		else
		{
			$response = array('status'=>1003, 'message'=>'Please Fill Input Fields...');
		}
		echo json_encode($response);
	}

	public function check_email($email)
	{
		$table = 'users';
		$where = array('email'=>$email);
		$result = $this->Api_model->get_num_rows($table, $where);
		if($result){
			return true ;
		}else{
			return false ;
		}
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		if($email !='' && $password !=''){
			$table = 'users';
			$where = array('email'=>$email,'password'=>md5($password));
			$result = $this->Api_model->get_num_rows($table, $where);
			$user_details = $this->Api_model->get_row_details($table, $where);
			if($result){
				$response = array('status'=>1000, 'message'=>'Successfully Login ...', 'data'=>$user_details);
			}else{
				$response = array('status'=>1003, 'message'=>'InValide Email or Password ...', 'data'=>'');	
			}
		}
		else
		{
			$response = array('status'=>1003, 'message'=>'Please Fill Input Feilds...', 'data'=>'');
		}
		echo json_encode($response);
	}

	public function user_profile_info()
	{
		$user_id = $this->input->post('user_id');
		if($user_id !=''){
			$table = 'users';
			$where = array('user_id'=>$user_id);
			$result = $this->Api_model->get_row_details($table, $where);
			if(count($result)>0){
				$response = array('status'=>1000, 'message'=>'User info ', 'data'=>$result);
			}else
			{
				$response = array('status'=>1003, 'message'=>'UserId Not Registered ...');
			}

		}
		else
		{
			$response = array('status'=>1003, 'message'=>'Please Fill UserId ...');
		}
		echo json_encode($response);
	}


	public function user_profile_update()
	{
		$user_id = $this->input->post('user_id');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email	 = $this->input->post('email');
		$city = $this->input->post('city');
		$mobile = $this->input->post('mobile');
		$password = $this->input->post('password');
		if($user_id !=''){
			$table = 'users';
			$where = array('user_id'=>$user_id);
			$result = $this->Api_model->get_row_details($table, $where);
			
			if(count($result)>0){
				$data = array(
						'first_name'=>$first_name, 
						'last_name'=>$last_name, 
						'email'=>$email,
						'password'=>md5($password),
						'city'=>$city,
						'mobile'=>$mobile,
						'updated_at'=>date('Y-m-d')
					);
				$this->session->set_userdata($data);
				$result_update = $this->Api_model->update_entry($table, $where, $data);
				
				//$check_email = $this->check_email($email);
				// if($check_email){
				// 	$response = array('status'=>1, 'message'=>'This email already exists ...');
				// 	echo json_encode($response);exit;
				// }
				if($result_update){
					$response = array('status'=>1000, 'message'=>'Successfully Updated  ...');
				}
				else
				{
					$response = array('status'=>1003, 'message'=>'Server Error ...');	
				}
			}
			else
			{
				$response = array('status'=>1003, 'message'=>'UserId Not Registered ...');
			}
		}
		else
		{
			$response = array('status'=>1003, 'message'=>'Please Fill UserId ...');
		}
		echo json_encode($response);
	}

	function send_email()
	{
		//print_r($subject);die;
		$email='rakesh.katsam@gmail.com';
		// $subject = $this->input->post( 'subject' );
		// $message = $this->input->post( 'message' );
		$subject = "subject";
		$message = "message";
		$subjectMAIL = $subject;
		$body    = $message;
		
		// ************ add rk 05-03-2020
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'investelite.in';
        $mail->SMTPAuth = true;
        $mail->Username = 'research@investelite.in';
        $mail->Password = 'Res@9599';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        $mail->setFrom('research@investelite.in', 'Investelite Research');
  		$mail->addAddress($email);

       	$testsubject = '"' . $subjectMAIL . '"';


        //$newtestsubject = $testsubject;
        //print_r($newtestsubject);die;
       	$mail->Subject = $testsubject;
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>
            <h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>
            <h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
       	$mailContent = $body;
       	$mail->Body = $mailContent;
        //$mail->Body = $body;
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
           	//return false ;
        }else{
        	//return true ;
            echo 'Message has been sent';
        }
        //die;
		// ************* end add rk 05-03-2020
	}

	public function send_mail_test() 
	{ 
        $from_email = "rakeshpatel0850@gmail.com"; 
        $to_email = $this->input->post('email'); 
   
         //Load email library 
        $this->load->library('email'); 
   
        $this->email->from($from_email, 'Rakesh'); 
        $this->email->to($to_email);
        $this->email->subject('Email Test'); 
        $this->email->message('Testing the email class.'); 
   
         //Send mail 
        if($this->email->send()) {
         	echo "Email sent successfully."; 
        }else{ 
        	echo "Error in sending Email."; 
      	}
         //$this->load->view('email_form'); 
    } 

	public function send_forget_url()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == FALSE)
		{ 
			//echo "false";
			echo validation_errors(); 
			//redirect('user');
		}
		else
		{	
			$email = $this->input->post('email');

			$where = array('email' => $email);
        	$user_data = $this->Api_model->get_row_details('users', $where);
        	//print_r($user_data->email);die;
        	if(count($user_data)>0)
        	{
        		$email=$user_data->email;
        		echo$url =  base_url('Api/forget_password_reset/?email=').$email;
        		die;
				$config['smtp_host'] = 'ssl://smtp.gmail.com';
				$config['smtp_user'] = 'rakeshp.techstone@gmail.com';
		     	$config['smtp_pass'] = 'rakesh@#$12345';
		     	$config['smtp_port'] = '465';
		     	$config['protocol'] = 'smtp';
		     	$config['mailpath'] = '';
		     	$config['mailtype'] = 'html';
		     	$config['charset'] = 'iso-8859-1';
		     	$config['wordwrap'] = true; 

		     	$this->load->library('email', $config);
		     	$this->email->set_newline("\r\n");
		     	$this->email->from('rakeshp.techstone@gmail.com');
		     	$this->email->to($email);   
		     	$this->email->subject('Mail For Test');

		     	//$url =  base_url('user/forget_password_reset/?email=').$email;
		     	$url =  base_url();
		     	$message = $url;
		     	$this->email->message($message);
		     	// if($this->email->attach('/uploads/a2.jpeg'))
		     	// {
		     	// 	echo "attach";
		     	// }else{
		     	// 	echo error_reporting(E_ERROR);
		     	// }
		     	if(!$this->email->send()) 
				{
					show_error($this->email->print_debugger());
					echo "Try again later";die;
				} 
				else
				{
					echo "successfully send email  Please check your email";die;
				}
			}
			else
			{
				echo  "Please enter correct email";exit;
			}
		}
	} 

	public function forget_password_reset()
	{
		$this->load->view('user/forget_password_reset');
	}

	public function logout(){
		$user_id = $this->input->post('user_id');
		$this->load->library('session');
		if($user_id!="")
		{
			session_destroy();
			$response = array('status'=>1000, 'message'=>'log Out successfully ...');
		}
		else
		{
			$response = array('status'=>1003, 'message'=>'Please Fill UserId ...');
		}
		echo json_encode($response);
	}

	public function create_room()
	{
		$user_id = $this->input->post('user_id');
		$room_name = $this->input->post('room_name');
		if($user_id!="" && $room_name!='')
		{
			$table = 'users';
			$where = array('user_id'=>$user_id);
			$result = $this->Api_model->get_row_details($table, $where);
			
			if(count($result)>0){
				$data = array('room_name'=>$room_name);
				
				$check_room_name = $this->Api_model->get_num_rows('room', array('room_name'=>$room_name));;
				if($check_room_name){
					$response = array('status'=>1005, 'message'=>'This Room Already Exists ...');
					echo json_encode($response);exit;
				}
				
				$result_insert = $this->Api_model->insert_entry('room', $data);
								
				if($result_insert){
					$response = array('status'=>1000, 'message'=>'Successfully Add Room','data'=>array('last_insert_room_id'=>$result_insert));
				}
				else
				{
					$response = array('status'=>1003, 'message'=>'Server Error ...');	
				}
			}
			else
			{
				$response = array('status'=>1003, 'message'=>'UserId Not Registered ...');
			}
			//$response = array('status'=>1000, 'message'=>'log Out successfully ...');
		}else{
			$response = array('status'=>1003, 'message'=>'Please Fill Input Feilds ...');	
		}
		echo json_encode($response);
	}

	public function create_button()
	{
		$user_id = $this->input->post('user_id');
		$room_id = $this->input->post('room_id');
		$button_name = $this->input->post('button_name');

		if($user_id!="" && $room_id!='' && $button_name!='')
		{
			$table = 'users';
			$where = array('user_id'=>$user_id);
			$result = $this->Api_model->get_row_details($table, $where);
			
			if(count($result)>0)
			{
				$data = array('button_name'=>$button_name);
				
				$check_room_name = $this->Api_model->get_num_rows('button_room', array('button_name'=>$button_name));;
				if($check_room_name){
					$response = array('status'=>1005, 'message'=>'This Room-button Already Exists ...');
					echo json_encode($response);exit;
				}
				
				$result_insert = $this->Api_model->insert_entry('button_room', $data);
								
				if($result_insert){
					$response = array('status'=>1000, 'message'=>'Successfully Add Room-button ','data'=>$result_insert);
				}
				else
				{
					$response = array('status'=>1003, 'message'=>'Server Error ...');	
				}	
			}
			else
			{
				$response = array('status'=>1003, 'message'=>'UserId Not Registered ...');
			}
		}
		else
		{
			$response = array('status'=>1003, 'message'=>'Please Fill Input Feilds ...');	
		}
		echo json_encode($response);
	}


	public function create_button_and_dimar()
	{
		$user_id = $this->input->post('user_id');
		$room_id = $this->input->post('room_id');
		$name = $this->input->post('name');
 		$type = $this->input->post('type');
 		$status = $this->input->post('status');
 		$isSchedule = $this->input->post('isSchedule');
 		$isOn = $this->input->post('isOn');
		
		if($user_id!="" && $room_id!='' && $name!='')
		{
			$table = 'users';
			$where = array('user_id'=>$user_id);
			$result = $this->Api_model->get_row_details($table, $where);
			
			if(count($result)>0)
			{
				//$type-0 = button $$ type-1 = dimar
				if($type==0){
					$data = array('button_name'=>$name, 'isSchedule'=>$isSchedule, 'isOn'=>$isOn, 'room_id'=>$room_id );
				
					$check_button_name = $this->Api_model->get_num_rows('button_room', array('button_name'=>$name, 'room_id'=>$room_id));;
					if($check_button_name){
						$response = array('status'=>1005, 'message'=>'This Button-Name Already Exists ...');
						echo json_encode($response);exit;
					}
					
					$result_insert = $this->Api_model->insert_entry('button_room', $data);
					$message = 'Successfully Add Button ..';
				}

				if($type==1){
					$data = array('dimar_name'=>$name, 'status'=>$status, 'room_id'=>$room_id );
					//echo "<pre>";print_r($data);die;
					$check_dimar_name = $this->Api_model->get_num_rows('dimar_room', array('dimar_name'=>$name, 'room_id'=>$room_id));;
					if($check_dimar_name){
						$response = array('status'=>1005, 'message'=>'This Dimar-Name Already Exists ...');
						echo json_encode($response);exit;
					}
					
					$result_insert = $this->Api_model->insert_entry('dimar_room', $data);
					$message = 'Successfully Add Dimar ..';
				}
								
				if($result_insert){
					$response = array('status'=>1000, 'message'=>$message);
				}
				else
				{
					$response = array('status'=>1003, 'message'=>'Server Error ...');	
				}	
			}
			else
			{
				$response = array('status'=>1003, 'message'=>'UserId Not Registered ...');
			}
		}
		else
		{
			$response = array('status'=>1003, 'message'=>'Please Fill Input Feilds ...');	
		}
		echo json_encode($response);
	}	

	public function home_data()
	{
		$get_room_details = $this->Api_model->get_details('room', $where='');
    	$result = array();
    	foreach ($get_room_details as $key => $row) {
    		$result[$row->room_id]['room_id'] = $row->room_id;
    		$result[$row->room_id]['room_name'] = $row->room_name;
    	 	$result[$row->room_id]['button'] = $this->Api_model->get_mutltiple_row_details('button_room', array('room_id'=>$row->room_id));
    	 	//echo "<pre>";print_r($get_button_room_details);
    	 	$result[$row->room_id]['dimmer'] = $this->Api_model->get_mutltiple_row_details('dimar_room', array('room_id'=>$row->room_id));
    	 	
    	 } 
    	if(count($result)>0){
    		$response = array('status'=>1000, 'message'=>'successfully show home-data ...', 'data'=>$result) ;	
    	}else{
    		$response = array('status'=>1003, 'message'=>'Data Not Found ...', 'data'=>'');	
    	}
    	echo json_encode($response);
	}


}
?>