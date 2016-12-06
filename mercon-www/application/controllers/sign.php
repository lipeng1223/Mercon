<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Sign extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        /*cache control*/
        //$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        //$this->output->set_header("Expires: Mon, 26 Jul 2020 05:00:00 GMT");
    }
	
    /**Default function, redirects to logged in user area**/
    public function index()
    {
		if ($this->session->userdata('login_id') > 0)
            redirect(base_url(), 'refresh');
		
		$page_data['page_name']  = 'login';
		
		$this->load->view('index', $page_data);
    }
    
    function sign_in()
	{
		$response = array();
		
		//Recieving post input of email, password from ajax request
		$username   = $this->input->post("email");
		$password 	= $this->input->post("password");
		//$remember   = $this->input->post("remember");
		$response['submitted_data'] = $_POST;		
		
		//Validating login
		$login_status = $this->validate_login( $username ,  $password );
		$response['login_status'] = $login_status;
		
		if ($login_status == 'success') {

			$response['redirect_url'] = '';
			
			/* if ($remember == 1){
			    $this->rememberme->setCookie($username);
			} else {
			    $this->rememberme->deleteCookie();
			} */
		}
		
		//Replying ajax request with validation response
		echo json_encode($response);
	}
    
    //Validating login from ajax request
    function validate_login($username =	'', $password	 =  '')
    {
		$password = md5($password.$this->config->item('encryption_key'));
        $credential	=	array('email' => $username , 'password' => $password, 'isActive'=>1);		 
		 
		 // Checking login credential for admin
        $query = $this->db->get_where('user' , $credential);
        
        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($row->role==1){
                $this->session->set_userdata('login_id', $row->id);
                $this->session->set_userdata('login_name', $row->displayName);
                $this->session->set_userdata('login_type', 'admin');
            }
            elseif ($row->role==2){
                $this->session->set_userdata('login_id', $row->id);
                $this->session->set_userdata('login_name', $row->displayName);
                $this->session->set_userdata('login_type', 'freelancer');
            }
			
			return 'success';
		}		
		return 'invalid';
    }
    
    function sign_up(){
        
        $company  = $this->input->post('company');
        $name  = $this->input->post('name');
        $address1  = $this->input->post('address1');
        $address2  = $this->input->post('address2');
        $city  = $this->input->post('city');
        $state  = $this->input->post('state');
        $country  = $this->input->post('country');
        $postcode  = $this->input->post('postcode');
        $phone  = $this->input->post('phone');
        $mobile  = $this->input->post('mobile');
        
        $email  = $this->input->post('email');
        $password  = $this->input->post('password');
        
        //check email
        $all_emails = $this->db->get_where('user', array('email'=>$email))->result_array();
        
        if (count($all_emails)>0){
            $result = false;
            $error = "email";
        }
        else {
            $encrypt = md5($password.$this->config->item('encryption_key'));
            $this->db->insert('user', array('displayName'=>$name, 'email'=>$email, 'password'=>$encrypt));
            $user_id = mysql_insert_id();
        
            $date_info['userID'] = $user_id;
            $date_info['companyName'] = $company;
            $date_info['contactName'] = $name;
            $date_info['addressL1'] = $address1;
            $date_info['addressL2'] = $address2;
            $date_info['city'] = $city;
            $date_info['state'] = $state;
            $date_info['postcode'] = $postcode;
            $date_info['country'] = $country;
            $date_info['email'] = $email;
            $date_info['phoneNumber'] = $phone;
            $date_info['mobileNumber'] = $mobile;
        
            $this->db->insert('customers', $date_info);
        
            $this->validate_login($email, $password);
            // Send an email; maybe invalid email address so not checking status
            //$this->email_model->account_opening_email("nh_user", $email);
        
            $result = true;
        }
                
        echo json_encode($result);
    }
	
    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() , 'refresh');
    }
}
