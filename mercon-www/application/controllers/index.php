<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	by L3
 */

class Index extends CI_Controller
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
        $page_data['slides'] = $this->db->order_by('sequence', 'ASC')->get('banner_slide')->result_array();
        $page_data['page_name']  = 'home';
        $this->load->view('index', $page_data);
    }
    
    /**
     * terms and conditions page
     */
    public function terms_conditions()
    {
        $page_data['page_name']  = 'terms_conditions';
        $this->load->view('index', $page_data);
    }
    
    /**
     * traing page
     */
    public function training()
    {
        $page_data['videos'] = $this->db->get_where('category_youtube', array('active'=>1))->result_array();
        $page_data['page_name']  = 'training';
        $this->load->view('index', $page_data);
    }
    
    /**
     * Datasheet
     */
    public function datasheets()
    {
        $page_data['pdfs'] = $this->db->get_where('category_pdf', array('active'=>1))->result_array();
        $page_data['page_name']  = 'datasheets';
        $this->load->view('index', $page_data);
    }
    
    /**
     * about us
     */
    public function about_us()
    {
        $page_data['content'] = read_file('uploads/about_us.blob');
        $page_data['page_name']  = 'about_us';
        $this->load->view('index', $page_data);
    }
}
