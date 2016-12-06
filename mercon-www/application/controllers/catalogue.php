<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalogue extends CI_Controller
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
        $page_data['page_name']  = 'catalogue';
        $this->load->view('index', $page_data);
    }
    
    /**
     * receive catalogue download request
     * return json result
     */
    function send_request(){        
    	$name = $_POST["name"];
    	$email = $_POST["email"];
    	$newsletter = $_POST["newsletter"];
    	
    	//check if email is exist in db
    	$contacts = $this->db->get_where('catalogue_downloads', array('contactEmail'=>$email))->result_array();
    	
    	$contactID = 0;
    	
    	if ( count($contacts) > 0){
    	    foreach ($contacts as $row){}
    	       	    
    	    $contactID = $row['contactID'];
    	    
    	    $update_data['contactName'] = $name;
    	    $update_data['confirmEmailSent'] = 1;
    	    $update_data['dateConfirmEmailSent'] = date('Y-m-d H:i:s');
    	    $update_data['contactEmailConfirmed'] = 0;
    	    $update_data['catalogueDownloaded'] = 0;
    	    $update_data['sendNewsletter'] = $newsletter;
    	    
    	    $this->db->where('contactID', $contactID);
    	    $this->db->update('catalogue_downloads', $update_data);
    	}
    	else{
    	    $insert_data['contactName'] = $name;
    	    $insert_data['contactEmail'] = $email;
    	    $insert_data['confirmEmailSent'] = 1;
    	    $insert_data['dateConfirmEmailSent'] = date('Y-m-d H:i:s');
    	    $insert_data['contactEmailConfirmed'] = 0;
    	    $insert_data['catalogueDownloaded'] = 0;
    	    $insert_data['sendNewsletter'] = $newsletter;
    	    	
    	    $this->db->insert('catalogue_downloads', $insert_data);
    	    
    	    $contactID = mysql_insert_id();
    	}
    	
    	$response = $this->email_model->do_catalogue_email($contactID, $email);
    	
    	//Replying ajax request with validation response
    	echo json_encode($response);
	}
	
	/**
	 * download
	 */
	function download($contactID=0, $key=''){
	    $security = md5($contactID.$this->config->item('encryption_key'));
	    
	    if ($security == $key){
	        $sql = "select * from catalogue_downloads where contactID = $contactID and TIMESTAMPDIFF(HOUR, dateConfirmEmailSent, now()) < 24";
	        $cnt = $this->db->query($sql)->num_rows();
	        
	        if ($cnt != 1){
	            redirect(site_url('catalogue_download_error/2'), 'refresh');
	        }
	        
	        $this->db->where('contactID', $contactID);
	        $this->db->update('catalogue_downloads', array('contactEmailConfirmed'=>1));
	        
	        $page_data['page_name']  = 'catalogue_download';
	        $page_data['id'] = $contactID;
	        $page_data['key'] = $key;
	        
	        $this->load->view('index', $page_data);
	    } else {
	        redirect(site_url('catalogue_download_error/1'), 'refresh');
	    }
	}
	
	/**
	 * download error
	 * param 1: key wrong, 2: not found contact
	 */
	function download_error($error = ''){
	    $page_data['state']  = $error;
	    $page_data['page_name']  = 'catalogue';
	    $this->load->view('index', $page_data);
	}
	
	/**
	 * create pdf & download by dompdf
	 */
	function generate_pdf1(){	    
	    $page_data['title'] = "Catalog List";
	    $page_data['root_id'] = 20;
	    
	    $this->load->library('pdf');
	    $this->pdf->load_view('pages/catalog_pdf', $page_data);
	    $this->pdf->render();
	    
	    //$output = $this->pdf->output();
	    //file_put_contents('uploads/pdf_generate/catalog.pdf', $output);
	    //echo json_encode(true);
	    
	    $this->pdf->stream("catalog.pdf");
	    
	    //$this->load->view('pages/catalog_pdf', $page_data);
	}
	
	/**
	 * create pdf & download tcpdf
	 */
	
	function generate_pdf(){
	    $this->load->library('pdf');

        $this->pdf->SetTitle('Catalog List for merriancontrols');

        //set header & footer
        $this->pdf->SetHeaderMargin(5);
        $this->pdf->setFooterMargin(10);
        $this->pdf->SetTopMargin(20);
        
        //set document info
        $this->pdf->SetAuthor('MerrimanControls');
        $this->pdf->SetDisplayMode('real', 'default');
        $this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        
        //add cover
        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);
        
        $this->pdf->AddPage();
        $cover_img = base_url()."assets/images/logo/logo.png";
        $cover_txt = "Catalog List";
        $this->pdf->AddCover($cover_img, $cover_txt);
                
        //add page
        $root_id = 1;
        if ($root_id == 1)
            $tops = $this->db->order_by('sequence', 'asc')->get_where('category', array('pid'=>$root_id, 'isHiddenInPdf'=>0, 'active'=>1))->result_array();
        else
            $tops = $this->db->order_by('sequence', 'asc')->get_where('category', array('id'=>$root_id,'isHiddenInPdf'=>0, 'active'=>1))->result_array();
        
        $this->pdf->setPrintHeader();
        
        $i = 1;
        
        foreach ($tops as $top){
            $this->pdf->AddPage();
            $this->pdf->setPrintFooter();
            
            $top_title = "$i. " . $top['keyword'];
            
            $this->pdf->Bookmark($top_title, 0, 0, '', 'B', array(0,0,0));
            $this->pdf->SetFont('times', 'B', 20);
            $this->pdf->Cell(0, 10, $top_title , 0, 1, 'L');
            
            $subs = $this->db->order_by('sequence', 'asc')->get_where('category', array('pid'=>$top['id'],'isHiddenInPdf'=>0, 'active'=>1))->result_array();
            
            if (count($subs) > 0) {
                $k = 1;
                foreach ($subs as $sub){
                    if ($k > 1) $this->pdf->AddPage();
                    
                    $sub_title = "$i.$k  " . $sub['keyword'];
                    $this->pdf->Bookmark($sub_title, 1, 0, '', '', array(0,0,0));
                    $this->pdf->SetFont('times', '', 16);
                    $this->pdf->Cell(0, 10, $sub_title , 0, 1, 'L');
                    
                    $this->pdf->SetFont('times', '', 10);
                    $this->pdf->load_view('pages/catalog_pdf', array('categoryid'=>$sub['id']));
                    
                    $k++;
                }
            }
            else {
                $this->pdf->SetFont('times', '', 10);
                $this->pdf->load_view('pages/catalog_pdf', array('categoryid'=>$top['id']));
            }
            
            $i++;            
        }
        
        //add index page
        $this->pdf->addTOCPage();
        $this->pdf->setPrintFooter(false);
        
        // write the TOC title
        $this->pdf->SetFont('times', 'B', 16);
        $this->pdf->MultiCell(0, 0, 'Table Of Content', 0, 'C', 0, 1, '', '', true, 0);
        $this->pdf->Ln();
        
        $this->pdf->SetFont('dejavusans', '', 12);
        
        // add a simple Table Of Content at first page
        $this->pdf->addTOC(2, 'courier', '.', 'INDEX', 'B', array(128,0,0));
        $this->pdf->endTOCPage();
        
        $this->pdf->Output(FCPATH.'uploads/pdf_generate/catalog.pdf', 'F');
        
        echo "success";
	}
	
	function download_pdf($contactID=0, $key=''){
	    $security = md5($contactID.$this->config->item('encryption_key'));
	    
	    if ($security == $key){
	        $sql = "select * from catalogue_downloads where contactID = $contactID and TIMESTAMPDIFF(HOUR, dateConfirmEmailSent, now()) < 24";
	        $cnt = $this->db->query($sql)->num_rows();
	    
	        if ($cnt != 1){
	            redirect(site_url('catalogue_download_error/2'), 'refresh');
	        }
	    
    	    $data = file_get_contents("uploads/pdf_generate/catalog.pdf");
    	    $name = 'catalog.pdf';
    	    
    	    force_download($name, $data);
	    
	    } else {
	        redirect(site_url('catalogue_download_error/1'), 'refresh');
	    }
	}
}
