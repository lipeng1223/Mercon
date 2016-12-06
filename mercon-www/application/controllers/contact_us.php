<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_us extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        //redirect(base_url() . 'index.php?front/home', 'refresh');
        $page_data['page_name']  = 'contact_us';
        $this->load->view('index', $page_data);
    }
    
    function send_contact_us(){        
    	$name = $_POST["name"];
    	$email = $_POST["email"];
    	$subject = $_POST["subject"];
    	$message = $_POST["message"];   
    	
    	// save to contact us table
    	$this->load->model('contact_us_model');
    	
    	$this->contact_us_model->id = 0;
    	$this->contact_us_model->name = $name;
		$this->contact_us_model->email = $email;
		$this->contact_us_model->subject = $subject;
		$this->contact_us_model->message = $message;
		$response = $this->contact_us_model->save();
    	
    	$response = $this->email_model->do_contact_email($message, $subject, $email, $name);

    	//Replying ajax request with validation response
    	//echo json_encode(true);
    	
    	$page_data['page_name']  = 'contact_us_submitted';
        $this->load->view('index', $page_data);
	}
}