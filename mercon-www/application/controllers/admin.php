<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author : Joyonto Roy
 *	date	: 1 August, 2014
 *	University Of Dhaka, Bangladesh
 *	Ekattor School & College Management System
 *	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller
{
    
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('csv');
		$this->load->library('csvimport');
		
       /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
    
    /***Category Level One***/
    function category($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
                
        if ($param1 == 'create') {
            $data['pid'] = $this->input->post('parentid');
            $data['keyword'] = $this->input->post('keyword');
            $data['description'] = $this->input->post('description');
            $data['active'] = 1;
            
            $this->db->insert('category', $data);
            $category_id = mysql_insert_id();
            
            $this->db->where('id', $category_id);
            $this->db->update('category', array('sequence'=>$category_id));
            
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/category_image/' . $category_id . '.jpg');
            
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/category/' . $data['pid'], 'refresh');
        }
        elseif ($param1 == 'update') {
            $data['pid'] = $this->input->post('parentid');
            $data['keyword'] = $this->input->post('keyword');
            $data['description'] = $this->input->post('description');
            $data['isHiddenInPdf'] = $this->input->post('isHide');
            $data['active'] = $this->input->post('active');
        
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/category_image/' . $param2 . '.jpg');
            
            $this->db->where('id', $param2);
            $this->db->update('category', $data);
            
            $this->crud_model->clear_cache();        
            redirect(base_url() . 'index.php?admin/category/' . $data['pid'], 'refresh');
        }
        elseif ($param1 == 'detail_update') {
            $data['categoryID'] = $param2;
            $data['categoryDetails'] = $this->input->post('content');
        
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/category_detail_image/' . $param2 . '.jpg');
            
            $num_rows = $this->db->get_where('category_details', array('categoryID'=>$param2))->num_rows();
        
            if ($num_rows > 0){
                $this->db->where('categoryID', $param2);
                $this->db->update('category_details', $data);
            }
            else {
                $this->db->insert('category_details', $data);
            }
        
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/category/' . $param3, 'refresh');
        }
        elseif ($param1 == 'delete'){
            $this->db->where('id', $param2);
            $this->db->delete('category');
            
            redirect(base_url() . 'index.php?admin/category/' . $param3, 'refresh');
        }
        elseif ($param1 == 'search'){
            $parentid = $this->input->post('parentid');
            redirect(base_url() . 'index.php?admin/category/'.$parentid, 'refresh');
        }
        
        if($param1 == "")
            $param1 = 1;
        $sql = "select A.keyword as parent, B.* from category as A inner join category as B on A.id=B.pid where B.pid=".$param1." order by B.sequence";
        
        $page_data['categorys'] = $this->db->query($sql)->result_array();
        $page_data['selected_id'] = $param1;
        
        $page_data['page_name']  = 'category';
        $page_data['page_title'] = get_phrase('category manager');
        $this->load->view('backend/index', $page_data);
    }
    
    /** category display order * */
    function category_up() {
        $result = false;
    
        $id = $this->input->post('id');
        $current = $this->db->get_where('category', array('id' => $id))->row();
        $currentOrder = $current->sequence;
    
        $sql = "SELECT id, sequence FROM category WHERE sequence = (SELECT max(sequence) FROM category WHERE sequence < $currentOrder)";
    
        $target = $this->db->query($sql)->result_array();
    
        foreach ($target as $row) {
            $target_id = $row['id'];
            $targetOrder = $row['sequence'];
    
            if ($targetOrder != null and $targetOrder != "") {
                $this->db->where('id', $id);
                $this->db->update('category', array('sequence' => $targetOrder));
    
                $sql = "UPDATE category SET sequence=$currentOrder where id=$target_id";
                $this->db->query($sql);
    
                $result = true;
            }
        }
    
        echo json_encode($result);
    }
    
    function category_down() {
        $result = false;
    
        $id = $this->input->post('id');
        $current = $this->db->get_where('category', array('id' => $id))->row();
        $currentOrder = $current->sequence;
    
        $sql = "SELECT id, sequence FROM category WHERE sequence = (SELECT min(sequence) FROM category WHERE sequence > $currentOrder)";
    
        $target = $this->db->query($sql)->result_array();
    
        foreach ($target as $row) {
            $target_id = $row['id'];
            $targetOrder = $row['sequence'];
    
            if ($targetOrder != null and $targetOrder != "") {
                $this->db->where('id', $id);
                $this->db->update('category', array('sequence' => $targetOrder));
    
                $sql = "update category set sequence=$currentOrder where id=$target_id";
                $this->db->query($sql);
    
                $result = true;
            }
        }
    
        echo json_encode($result);
    }
    
    function category_content($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'pdf_create') {
            $data['cateid'] = $param2;
            $data['title'] = $this->input->post('title');
        
            if ($_FILES['pdf']['tmp_name'] != null){
                $filename = preg_replace("/\s+/", "", $_FILES['pdf']['name']);
                move_uploaded_file($_FILES['pdf']['tmp_name'], 'uploads/category_pdf/'.$filename);
                $data['filename'] = $filename;
            }
        
            $this->db->insert('category_pdf', $data);
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param2, 'refresh');
        }        
        elseif ($param1 == 'pdf_update') {
            $data['title'] = $this->input->post('title');
        
            if ($_FILES['pdf']['tmp_name'] != null){
                $filename = preg_replace("/\s+/", "", $_FILES['pdf']['name']);
                move_uploaded_file($_FILES['pdf']['tmp_name'], 'uploads/category_pdf/'.$filename);
                $data['filename'] = $filename;
            }
        
            $this->db->where('id', $param2);
            $this->db->update('category_pdf', $data);
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param3, 'refresh');
        }
        elseif ($param1 == 'pdf_delete'){
            $this->db->where('id', $param2);
            $this->db->delete('category_pdf');
            
            redirect(base_url() . 'index.php?admin/category_content/' . $param3, 'refresh');
        }
        elseif ($param1 == 'video_create') {
            $data['cateid'] = $param2;
            $data['title'] = $this->input->post('title');
            $data['url'] = $this->input->post('url');
        
            $this->db->insert('category_youtube', $data);
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param2, 'refresh');
        }
        elseif ($param1 == 'video_update') {
            $data['title'] = $this->input->post('title');
            $data['url'] = $this->input->post('url');
        
            $this->db->where('id', $param2);
            $this->db->update('category_youtube', $data);
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param3, 'refresh');
        }
        elseif ($param1 == 'video_delete'){
            $this->db->where('id', $param2);
            $this->db->delete('category_youtube');
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param3, 'refresh');
        }
        elseif ($param1 == 'link_create') {
            $data['cateid'] = $param2;
            $data['linkName'] = $this->input->post('linkName');
            $data['linkAddress'] = $this->input->post('linkAddress');
        
            $this->db->insert('category_links', $data);
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param2, 'refresh');
        }
        elseif ($param1 == 'link_update') {
            $data['linkName'] = $this->input->post('linkName');
            $data['linkAddress'] = $this->input->post('linkAddress');
        
            $this->db->where('id', $param2);
            $this->db->update('category_links', $data);
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param3, 'refresh');
        }
        elseif ($param1 == 'link_delete'){
            $this->db->where('id', $param2);
            $this->db->delete('category_links');
        
            redirect(base_url() . 'index.php?admin/category_content/' . $param3, 'refresh');
        }
        
        $page_data['pdfs'] = $this->db->get_where('category_pdf', array('cateid'=>$param1))->result_array();
        $page_data['videos'] = $this->db->get_where('category_youtube', array('cateid'=>$param1))->result_array();
        $page_data['links'] = $this->db->get_where('category_links', array('cateid'=>$param1))->result_array();
        
        $page_data['cateid'] = $param1;
        $page_data['category_name'] = $this->db->get_where('category',array('id'=>$param1))->row()->keyword;
        $page_data['page_name']  = 'category_content';
        $page_data['page_title'] = get_phrase('category_technology_manager');
        $this->load->view('backend/index', $page_data);
    }
    
    function product($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'search'){
            $cate1 = $this->input->post('cate1');
            $cate2 = $this->input->post('cate2');
            $page_data['cate1']  = $cate1;
            $page_data['cate2'] = $cate2;
            
            if($cate2 > 0)
                $this->db->where('categoryid',$cate2);
            elseif ($cate1 > 1)
                $this->db->where('categoryid',$cate1);
            
            $page_data['products'] = $this->db->order_by('sequence', 'asc')->get('product_keyword')->result_array();
            $page_data['cate1name'] = $this->db->get_where('category',array('id'=>$cate1))->row()->keyword;
            $page_data['cate2name'] = $this->db->get_where('category',array('id'=>$cate2))->row()->keyword;;
        }
        elseif ($param1 == 'create') {
            if ($this->input->post('cate2') > 0)
                $data['categoryid'] = $this->input->post('cate2');
            elseif ($this->input->post('cate1') > 0)
                $data['categoryid'] = $this->input->post('cate1');
            
            $data['name'] = $this->input->post('name');
            $data['count'] = $this->input->post('count');
            $data['active'] = 1;
        
            $this->db->insert('product_keyword', $data);
            $product_id = mysql_insert_id();
            
            $this->db->where('id', $product_id);
            $this->db->update('product_keyword', array('sequence'=>$product_id));
            
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $product_id . '.jpg');
            
            for ($i=1; $i<=$this->input->post('count'); $i++){
                $this->db->insert('product_items',array('productid'=>$product_id,'active'=>1));
            }
        
            redirect(base_url() . 'index.php?admin/product_item/'.$product_id, 'refresh');
        }
        elseif ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['active'] = $this->input->post('active');
        
            $this->db->where('id', $param2);
            $this->db->update('product_keyword', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/product_image/' . $param2 . '.jpg');
        
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/product/', 'refresh');
        }
        elseif ($param1 == 'delete'){
            $this->db->where('id', $param2);
            $this->db->delete('product_keyword');
            
            $this->db->where('productid',$param2);
            $this->db->delete('product_items');
        
            redirect(base_url() . 'index.php?admin/product/', 'refresh');
        }
        
        //$page_data['categorys'] = $this->db->query($sql)->result_array();
        //$page_data['selected_id'] = $param1;
        
        $page_data['page_name']  = 'product_keyword';
        $page_data['page_title'] = get_phrase('product manager');
        $this->load->view('backend/index', $page_data);
    }
    
    /**product display order * */
    function product_up() {
        $result = false;
    
        $id = $this->input->post('id');
        $current = $this->db->get_where('product_keyword', array('id' => $id))->row();
        $currentOrder = $current->sequence;
    
        $sql = "SELECT id, sequence FROM product_keyword WHERE sequence = (SELECT max(sequence) FROM product_keyword WHERE sequence < $currentOrder)";
    
        $target = $this->db->query($sql)->result_array();
    
        foreach ($target as $row) {
            $target_id = $row['id'];
            $targetOrder = $row['sequence'];
    
            if ($targetOrder != null and $targetOrder != "") {
                $this->db->where('id', $id);
                $this->db->update('product_keyword', array('sequence' => $targetOrder));
    
                $sql = "UPDATE product_keyword SET sequence=$currentOrder where id=$target_id";
                $this->db->query($sql);
    
                $result = true;
            }
        }
    
        echo json_encode($result);
    }
    
    function product_down() {
        $result = false;
    
        $id = $this->input->post('id');
        $current = $this->db->get_where('product_keyword', array('id' => $id))->row();
        $currentOrder = $current->sequence;
    
        $sql = "SELECT id, sequence FROM product_keyword WHERE sequence = (SELECT min(sequence) FROM product_keyword WHERE sequence > $currentOrder)";
    
        $target = $this->db->query($sql)->result_array();
    
        foreach ($target as $row) {
            $target_id = $row['id'];
            $targetOrder = $row['sequence'];
    
            if ($targetOrder != null and $targetOrder != "") {
                $this->db->where('id', $id);
                $this->db->update('product_keyword', array('sequence' => $targetOrder));
    
                $sql = "update product_keyword set sequence=$currentOrder where id=$target_id";
                $this->db->query($sql);
    
                $result = true;
            }
        }
    
        echo json_encode($result);
    }
    
    function product_item($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'save') {
            $ids = $this->input->post('id');
            $partnos = $this->input->post('partno');
            $sizes = $this->input->post('size');
            $prices = $this->input->post('price');
            $codes = $this->input->post('code');
            $weights = $this->input->post('weight');
            $colors = $this->input->post('color');
            $actives = $this->input->post('active');
            
            for ($i=0; $i<count($ids); $i++){
                $data = array();
                $id = $ids[$i];
                $data['partno'] = $partnos[$i];
                $data['size'] = $sizes[$i];
                if ($prices[$i]==null || $prices[$i]=="")
                    $data['price'] = 0;
                else
                    $data['price'] = $prices[$i];
                $data['code'] = $codes[$i];
                $data['weight'] = $weights[$i];
                $data['color'] = $colors[$i];
                $data['active'] = $actives[$i];
                
                $this->db->where('id',$id);
                $this->db->update('product_items',$data);
            }
        
            redirect(base_url() . 'index.php?admin/product_item/'.$param2, 'refresh');
        }
        elseif ($param1 == 'delete'){
            $this->db->where('id', $param2);
            $this->db->delete('product_items');
            
            $this->db->set('count', 'count-1', FALSE);
            $this->db->update('product_keyword');
        
            redirect(base_url() . 'index.php?admin/product_item/'.$param3, 'refresh');
        }
        elseif ($param1 == 'create'){
            $data['productid'] = $param2;
            $data['partno'] = $this->input->post('partno');
            $data['size'] = $this->input->post('size');
            $data['price'] = $this->input->post('price');
            $data['code'] = $this->input->post('code');
            $data['weight'] = $this->input->post('weight');
            $data['color'] = $this->input->post('color');
            $data['active'] = 1;
            
            $this->db->insert('product_items', $data);
            
            $this->db->set('count', 'count+1', FALSE);
            $this->db->update('product_keyword');
            
            redirect(base_url() . 'index.php?admin/product_item/'.$param2, 'refresh');
        }
        elseif ($param1 == 'fix'){
            $percent = $this->input->post('fixprice');
            $fix = $percent/100;
            
            $this->db->where('productid',$param2);
            $this->db->set('price', 'price*'.$fix, FALSE);
            $this->db->update('product_items');
            
            redirect(base_url() . 'index.php?admin/product_item/'.$param2, 'refresh');
        }
        
        $product_name = $this->db->get_where('product_keyword',array('id'=>$param1))->row()->name;
        $page_data['product_name'] = $product_name;
        
        $page_data['items'] = $this->db->get_where('product_items',array('productid'=>$param1))->result_array();
        $page_data['productid'] = $param1;
        $page_data['page_name']  = 'product_item';
        $page_data['page_title'] = get_phrase('product_item');
        $this->load->view('backend/index', $page_data);
    }
    
    function price_page($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'update_by_percent') {
            $percent  = $this->input->post('percent');
            
            $fix = $percent/100;
            
            $this->db->set('price', 'price*'.$fix, FALSE);
            $this->db->update('product_items');
            
            redirect(base_url() . 'index.php?admin/price_page/', 'refresh');
        }
        if ($param1 == 'update_by_fix') {
            $amount   = $this->input->post('amount');
            
            $this->db->set('price', 'price'.$amount, FALSE);
            $this->db->update('product_items');

            redirect(base_url() . 'index.php?admin/price_page/', 'refresh');
        }
        
        $page_data['page_name']  = 'price_page';
        $page_data['page_title'] = get_phrase('manage_price_on_page');
        $this->load->view('backend/index', $page_data);
    }
    
    function price_file($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    
        if ($param1 == 'import') {
            move_uploaded_file($_FILES['importfile']['tmp_name'], 'uploads/import.csv');

			$csv = $this->csvimport->get_array('uploads/import.csv');
			foreach ($csv as $value) {
				
				if ($value['id']==""){
					continue;
				}
				
				$data['price']     = $value['price'];

				$this->db->where('id',$value['id']);
				$this->db->update('product_items', $data);				
			}
    
            redirect(base_url() . 'index.php?admin/price_file/', 'refresh');
        }
    
        $page_data['page_name']  = 'price_file';
        $page_data['page_title'] = get_phrase('manage_price_by_file');
        $this->load->view('backend/index', $page_data);
    }
    
    function price_export(){
        $sql = "SELECT product_items.id, category.keyword as categoryname, product_keyword.name as title, product_items.partno,product_items.size,product_items.price,product_items.code,product_items.weight ";
        $sql .= "FROM category inner join product_keyword on category.id=product_keyword.categoryid inner join product_items on product_keyword.id=product_items.productid";
        $query = $this->db->query($sql);
        
        echo query_to_csv($query, TRUE, "price.csv");
    }
    
    //ajax controller to get cate2
    function ajax_get_cate2(){
        $response = "<option value></option>";
         
        $cate1 = $_POST["cate1"];
         
        $cate2s =  $this->db->get_where('category' , array('pid'=>$cate1))->result_array();
         
        foreach ($cate2s as $row){
            $response .=  "<option value='".$row['id']."'>";
            $response .= $row['keyword'];
            $response .= "</option>";
        }
         
        //Replying ajax request with validation response
        echo json_encode($response);
    }
    
    /**
     * customer management
     */
    
    function customer_management($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1=='delete'){
            $this->db->where('customerID', $param2);
            $this->db->update('customer', array('isDeleted'=>1));
            
            redirect(base_url() . 'index.php?admin/customer_management/', 'refresh');
        }
        
        $page_data['customers'] = $this->db->get_where('customer', array('isDeleted'=>0))->result_array();
        
        $page_data['page_name']  = 'customer_management';
        $page_data['page_title'] = get_phrase('customer_management');
        
        $this->load->view('backend/index', $page_data);
    }
    
    /**
     * download customer list
     */
    function customer_export(){
        $list = $this->db->get_where('customer', array('isDeleted'=>0));
        $date = date('Y_m_d_h_i_s');
        echo query_to_csv($list, TRUE, "CustomerList_".$date.".csv");
    }
    
    /**
     * banner slide management
     */
    function banner_management($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        $online_db = $this->load->database('default', TRUE);
        $online_url = $this->config->item('online_url');
        
        if ($param1 == 'create') {
            $sql = "SELECT IFNULL(max(sequence),0)+1 as maxseq FROM banner_slide";
            $maxseq = $this->db->query($sql)->row()->maxseq;
            
            $data['title'] = $this->input->post('title');
            $data['sub_title'] = $this->input->post('sub_title');
            $data['button_text'] = $this->input->post('button_text');
            $data['button_link'] = $this->input->post('button_link');
            $data['sequence'] = $maxseq;
            
            $this->db->insert('banner_slide', $data);
            $slide_id = mysql_insert_id();

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slide_image/' . $slide_id . '.jpg');
            
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/banner_management', 'refresh');
        }
        elseif ($param1 == 'remote_create') {
            $sql = "SELECT IFNULL(max(sequence),0)+1 as maxseq FROM banner_slide";
            $maxseq = $online_db->query($sql)->row()->maxseq;
        
            $data['title'] = $this->input->post('title');
            $data['sub_title'] = $this->input->post('sub_title');
            $data['button_text'] = $this->input->post('button_text');
            $data['button_link'] = $this->input->post('button_link');
            $data['sequence'] = $maxseq;
        
            $online_db->insert('banner_slide', $data);
            $slide_id = mysql_insert_id();
            
            if ($_FILES['userfile']['tmp_name'] != null) {
                $filename = $_FILES['userfile']['tmp_name'];
                $handle    = fopen($filename, "r");
                $image      = fread($handle, filesize($filename));
                
                $this->crud_model->remote_upload($image, 'slide', $slide_id);                
            }
                
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/banner_management', 'refresh');
        }
        elseif ($param1 == 'update') {
            $data['title'] = $this->input->post('title');
            $data['sub_title'] = $this->input->post('sub_title');
            $data['button_text'] = $this->input->post('button_text');
            $data['button_link'] = $this->input->post('button_link');
        
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slide_image/' . $param2 . '.jpg');
            
            $this->db->where('id', $param2);
            $this->db->update('banner_slide', $data);
            
            $this->crud_model->clear_cache();        
            redirect(base_url() . 'index.php?admin/banner_management', 'refresh');
        }
        elseif ($param1 == 'remote_update') {
            $data['title'] = $this->input->post('title');
            $data['sub_title'] = $this->input->post('sub_title');
            $data['button_text'] = $this->input->post('button_text');
            $data['button_link'] = $this->input->post('button_link');
        
            if ($_FILES['userfile']['tmp_name'] != null) {
                $filename = $_FILES['userfile']['tmp_name'];
                $handle    = fopen($filename, "r");
                $image      = fread($handle, filesize($filename));
            
                $this->crud_model->remote_upload($image, 'slide', $param2);
            }
        
            $online_db->where('id', $param2);
            $online_db->update('banner_slide', $data);
        
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/banner_management', 'refresh');
        }
        elseif ($param1 == 'delete'){
            $this->db->where('id', $param2);
            $this->db->delete('banner_slide');
            
            redirect(base_url() . 'index.php?admin/banner_management/' . $param3, 'refresh');
        }
        elseif ($param1 == 'remote_delete'){
            $online_db->where('id', $param2);
            $online_db->delete('banner_slide');
        
            redirect(base_url() . 'index.php?admin/banner_management/' . $param3, 'refresh');
        }
        
        $page_data['page_name']  = 'banner_management';
        $page_data['page_title'] = get_phrase('banner_slider');
        $page_data['slides']  = $this->db->order_by('sequence', 'ASC')->get('banner_slide')->result_array();
        
        //$page_data['onlines']  = $online_db->order_by('sequence', 'ASC')->get('banner_slide')->result_array();
        
        $this->load->view('backend/index', $page_data);
    }
    
    /**
     * banner slide management
     */
    function pslide_management($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    
        if ($param1 == 'create') {
            $sql = "SELECT IFNULL(max(sequence),0)+1 as maxseq FROM product_slide";
            $maxseq = $this->db->query($sql)->row()->maxseq;
    
            /* $data['title'] = $this->input->post('title');
            $data['sub_title'] = $this->input->post('sub_title');
            $data['button_text'] = $this->input->post('button_text');
            $data['button_link'] = $this->input->post('button_link'); */
            $data['sequence'] = $maxseq;
    
            $this->db->insert('product_slide', $data);
            $slide_id = mysql_insert_id();
    
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/pslide_image/' . $slide_id . '.jpg');
    
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/pslide_management', 'refresh');
        }
        elseif ($param1 == 'update') {
           /*  $data['title'] = $this->input->post('title');
            $data['sub_title'] = $this->input->post('sub_title');
            $data['button_text'] = $this->input->post('button_text');
            $data['button_link'] = $this->input->post('button_link'); */
    
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/pslide_image/' . $param2 . '.jpg');
    
            /* $this->db->where('id', $param2);
            $this->db->update('product_slide', $data); */
    
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/pslide_management', 'refresh');
        }
        elseif ($param1 == 'delete'){
            $this->db->where('id', $param2);
            $this->db->delete('product_slide');
    
            redirect(base_url() . 'index.php?admin/pslide_management/' . $param3, 'refresh');
        }
    
        $page_data['page_name']  = 'pslide_management';
        $page_data['page_title'] = get_phrase('product_slide');
        $page_data['slides']  = $this->db->order_by('sequence', 'ASC')->get('product_slide')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function slide_up() {
        $result = false;
    
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        
        $current = $this->db->get_where($table, array('id' => $id))->row();
        $currentOrder = $current->sequence;
    
        $sql = "SELECT id, sequence FROM $table WHERE sequence = (SELECT max(sequence) FROM $table WHERE sequence < $currentOrder)";
    
        $target = $this->db->query($sql)->result_array();
    
        foreach ($target as $row) {
            $target_id = $row['id'];
            $targetOrder = $row['sequence'];
    
            if ($targetOrder != null and $targetOrder != "") {
                $this->db->where('id', $id);
                $this->db->update($table, array('sequence' => $targetOrder));
    
                $sql = "UPDATE $table SET sequence=$currentOrder where id=$target_id";
                $this->db->query($sql);
    
                $result = true;
            }
        }
    
        echo json_encode($result);
    }
    
    function slide_down() {
        $result = false;
    
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        
        $current = $this->db->get_where($table, array('id' => $id))->row();
        $currentOrder = $current->sequence;
    
        $sql = "SELECT id, sequence FROM $table WHERE sequence = (SELECT min(sequence) FROM $table WHERE sequence > $currentOrder)";
    
        $target = $this->db->query($sql)->result_array();
    
        foreach ($target as $row) {
            $target_id = $row['id'];
            $targetOrder = $row['sequence'];
    
            if ($targetOrder != null and $targetOrder != "") {
                $this->db->where('id', $id);
                $this->db->update($table, array('sequence' => $targetOrder));
    
                $sql = "update $table set sequence=$currentOrder where id=$target_id";
                $this->db->query($sql);
    
                $result = true;
            }
        }
    
        echo json_encode($result);
    }
    
    function pvideo_management($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'save') {
            $this->db->where('id !=', 'NULL');
            $this->db->delete('product_video');
            $url = $this->input->post('url');
            $this->db->insert('product_video', array('url'=>$url));
            redirect(base_url() . 'index.php?admin/pvideo_management', 'refresh');
        }
    
        $page_data['page_name']  = 'pvideo_management';
        $page_data['page_title'] = get_phrase('product_video');
        $page_data['video'] = $this->db->limit(1)->get('product_video')->row();
        $this->load->view('backend/index', $page_data);
    }
    
    /**
     * about us image management
     */
    function about_us_images($param1 = '', $param2 = '', $param3 = ''){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
    
        if ($param1 == 'create') {
    
            if ($_FILES['image_file']['tmp_name'] != null) {
                $target_dir = "uploads/about_us_image/";
                $filename = "about_us_".preg_replace('/\s+/', '_', $_FILES['image_file']['name']);
                
                move_uploaded_file($_FILES['image_file']['tmp_name'], $target_dir.$filename);
                $data['image_name'] = $filename;
                
                $this->db->insert('about_us_images', $data);
            }
    
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/about_us_images', 'refresh');
        }
        elseif ($param1 == 'update') {
            
            if ($_FILES['image_file']['tmp_name'] != null) {
                $target_dir = "uploads/about_us_image/";
                $filename = "about_us_".preg_replace('/\s+/', '_', $_FILES['image_file']['name']);
                
                move_uploaded_file($_FILES['image_file']['tmp_name'], $target_dir.$filename);
                $data['image_name'] = $filename;
                
                $this->db->where('id', $param2);
                $this->db->update('about_us_images', $data);
            }
            
            $this->crud_model->clear_cache();
            redirect(base_url() . 'index.php?admin/about_us_images', 'refresh');
        }
        elseif ($param1 == 'delete'){
            $this->db->where('id', $param2);
            $this->db->delete('about_us_images');
    
            redirect(base_url() . 'index.php?admin/about_us_images', 'refresh');
        }
    
        $page_data['page_name']  = 'about_us_images';
        $page_data['page_title'] = get_phrase('about_us_images');
        $page_data['images']  = $this->db->get('about_us_images')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function about_us_content($action){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($action == 'save'){
            $content = $this->input->post('content');
            write_file('uploads/about_us.blob', $content);
            
            redirect(base_url() . 'index.php?admin/about_us_content', 'refresh');
        }
        
        $page_data['content'] = read_file('uploads/about_us.blob');
        
        $page_data['page_name']  = 'about_us_content';
        $page_data['page_title'] = get_phrase('about_us_content');        
        $this->load->view('backend/index', $page_data);
    }
    
    function contact_us(){
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        $this->load->model('contact_us_model');
        $page_data['page_name']  = 'contact_us';
        $page_data['page_title'] = 'contact_us';
        $page_data['contact_us_data']  = $this->contact_us_model->get_all_as_array();
        
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
    
            $this->db->where('id', $this->session->userdata('admin_id'));
            $this->db->update('user', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
    
            $current_password = $this->db->get_where('user', array('id' => $this->session->userdata('admin_id')))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('id', $this->session->userdata('admin_id'));
                $this->db->update('user', array('password' => $data['new_password']));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('user', array('id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }
}
