<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us_model extends CI_Model {

	var $id;
	var $name;
	var $email;
	var $subject;
	var $message;
	var $datetime;
	var $status;
	var $isDeleted;

	function __construct($_id=0) {
		parent::__construct();
		$this->init($_id);
	}
    
    function init($_id=0) {
    	if($_id > 0) {
			$this->load($_id);
		}else{
			$this->id = 0;
			$this->name = '';
			$this->email = '';
			$this->subject = '';
			$this->message = '';
			$this->datetime = time();
			$this->status = 0;
			$this->isDeleted = 0;
		}
    }
    
    function load($_id) {
    	$query = $this->db->get_where('contact_us', array('id' => $_id));
		if ($query->num_rows() > 0){
    		foreach ($query->result() as $row)
			{
				$this->id = $row->id;
				$this->name = $row->name;
				$this->email = $row->email;
				$this->subject = $row->subject;
				$this->message = $row->message;
				$this->datetime = $row->datetime;
				$this->status = $row->status;
				$this->isDeleted = $row->isDeleted;
			}
		}
		
    }
    
	function delete_by_id($_id) {
		$data = array(
			'is_deleted' => 1
		);
		$this->db->where('id', $this->$_id);
		$this->db->update('contact_us', $data);
	}
	
	function get_all_as_array() {
		$this->db->from('contact_us');
		$this->db->order_by("id", "desc");
		$query = $this->db->get(); 
    	$return_array = $query->result();
    	return $return_array;
	}
    
    function get_as_array() {
		$data = array(
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'subject' => $this->subject,
			'message' => $this->message,
			'datetime' => $this->datetime,
			'status' => $this->status,
			'isDeleted' => $this->isDeleted
		);
		return $data;
	}
    
    function save() {
    	$data = array(
			'name' => $this->name,
			'email' => $this->email,
			'subject' => $this->subject,
			'message' => $this->message,
			'datetime' => $this->datetime,
			'status' => $this->status,
			'isDeleted' => $this->isDeleted
		);
		
		if ($this->id == 0) {
			// insert
			$this->db->insert('contact_us', $data);
			$this->id = $this->db->insert_id();
		}else{
			// update
			$this->db->where('id', $this->id);
			$this->db->update('contact_us', $data);
		}
		
		return $this->id;
    }
    
}

?>