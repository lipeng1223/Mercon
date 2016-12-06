<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products extends CI_Controller
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
        $page_data['slides'] = $this->db->order_by('sequence', 'ASC')->get('product_slide')->result_array();
        $page_data['video'] = $this->db->limit(1)->get('product_video')->row()->url;
        
        $page_data['page_name']  = 'products';
        $page_data['sub_page']  = 'product_front';
        
        $this->load->view('index', $page_data);
    }
    
    function sub($categoryID = 0){
        /*
        if ($categoryID == 0)
            redirect(site_url('products'), 'refresh');
        */
        
        if ($categoryID == 0){
            
            $page_data['page_name']  = 'products';
            $page_data['sub_page']  = 'cable_trays';
            
            $this->load->view('index', $page_data);
        }
        else {
        
            $sql = "select count(id) as cnt from category where pid = $categoryID and active=1";
            $cnt = $this->db->query($sql)->row()->cnt;
            
            if ($cnt==0)
                redirect(site_url('products_detail/'.$categoryID), 'refresh');
            
            $page_data['category_info'] = $this->db->get_where('category', array('id'=>$categoryID))->row();
            $page_data['subs'] = $this->db->order_by('sequence', 'asc')->get_where('category', array('pid'=>$categoryID, 'active'=>1))->result_array();
            
            $page_data['page_name']  = 'products';
            $page_data['sub_page']  = 'product_sub';
            
            $this->load->view('index', $page_data);
        }
    }
    
    function detail($cateid = 0){
        if ($cateid == 0)
            redirect(site_url('products'), 'refresh');
    
       /*  $sql = "select count(id) as cnt from category where pid = $categoryID and active=1";
        $cnt = $this->db->query($sql)->row()->cnt;
    
        if ($cnt==0)
            redirect(site_url('products_detail/'.$categoryID), 'refresh'); */
        
        $sql = "select (select a.keyword from category as a where a.id=b.pid and a.id>1) as parent, b.keyword as child from category as b where b.id=".$cateid;
        $result = $this->db->query($sql)->row();
        $page_data['parent'] = $result->parent;
        $page_data['child'] = $result->child;
        
        $page_data['cateid'] = $cateid;
        $page_data['detail'] = $this->db->get_where('category_details', array('categoryID'=>$cateid))->row()->categoryDetails;
        
        $page_data['pdfs'] = $this->db->get_where('category_pdf', array('cateid'=>$cateid))->result_array();
        $page_data['videos'] = $this->db->get_where('category_youtube', array('cateid'=>$cateid))->result_array();
        $page_data['links'] = $this->db->get_where('category_links', array('cateid'=>$cateid))->result_array();
        
        $page_data['products'] = $this->db->order_by('sequence', 'asc')->get_where('product_keyword', array('active'=>1, 'categoryid'=>$cateid))->result_array();
    
        $page_data['page_name']  = 'products';
        $page_data['sub_page']  = 'product_detail';
    
        $this->load->view('index', $page_data);
    }
}
