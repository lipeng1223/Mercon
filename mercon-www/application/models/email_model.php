<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function account_opening_email($account_type = '', $email = '') {
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;

        $email_msg = "Welcome to " . $system_name . "<br />";
        $email_msg .= "Your account type : " . $account_type . "<br />";
        $email_msg .= "Your login password : " . $this->db->get_where($account_type, array('email' => $email))->row()->password . "<br />";
        $email_msg .= "Login Here : " . base_url() . "<br />";

        $email_sub = "Account opening email";
        $email_to = $email;

        $this->do_email($email_msg, $email_sub, $email_to);
    }

    /** password reset * */
    function password_reset_email($account_type = '', $email = '') {
        $query = $this->db->get_where($account_type, array('email' => $email));
        if ($query->num_rows() > 0) {
            $password = $query->row()->password;
            //$email_msg	=	"Your account type is : ".$account_type."<br />";
            $email_msg = "Your password is : " . $password . "<br />";

            $email_sub = "Password find request";
            $email_to = $email;

            $result = $this->do_email($email_msg, $email_sub, $email_to);
            return $result;
        } else {
            return false;
        }
    }

    /*     * catalogue send* */

    function do_catalogue_email($contactID, $email = NULL) {

        $key = md5($contactID . $this->config->item('encryption_key'));
        $url = site_url("index.php?catalogue/download/" . $contactID . "/" . $key);

        $subject = "Merriman Controls Product Catalogue Download";
        $message = "Thank you<br>
	                Please click <a href='$url'>here</a> to download our product catalogue or paste the following link to start the download.<br>
	                " . $url . "
	                <br><br><br>
	                Merriman Controls<br>
	                E: sales@merrimancontrols.com<br>
	                W: http://www.merrimancontrols.com";

        return $this->do_email($message, $subject, $email);
    }

    /** contact us * */
    function do_contact_email($message = "", $subject = "", $from = "", $name) {
        $to = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description; // Changed from master_email to system_email

        return $this->do_email($message, $subject, $to, $from, $name);
    }

    /*     * *custom email sender*** */

    function do_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL, $from_name = NULL) {

        $config = array();

        $config['useragent'] = "CodeIgniter";
        $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "mail.centralinfo.com.au"; //ssl://smtp.googlemail.com
        $config['smtp_port'] = "25";
        $config['smtp_user'] = "relay@ci-mail.centralinfo.com.au";
        $config['smtp_pass'] = "cispass123";
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;

        /*
          $config['useragent']	= "CodeIgniter";
          $config['mailpath']		= "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
          $config['protocol']		= "smtp";
          $config['smtp_host']	= "mail.centralinfo.com.au";//ssl://smtp.googlemail.com
          $config['smtp_port']	= "587";
          $config['smtp_user']	= "relay@ci-mail.centralinfo.com.au";
          $config['smtp_pass']	= "cispass123";
          $config['mailtype']		= 'html';
          $config['charset']		= 'utf-8';
          $config['newline']		= "\r\n";
          $config['wordwrap']		= TRUE;
         */
        $this->load->library('email');

        $this->email->initialize($config);

        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;

        if ($from_name == NULL)
            $from_name = $system_name;

        if ($from == NULL)
            $from = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;

        $system_site = $this->db->get_where('settings', array('type' => 'system_site'))->row()->description;

        $this->email->from($from, $from_name);
        $this->email->to($to);
        $this->email->subject($sub);

        //$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href='" .$system_site. "'>&copy; ". $system_name ."</a></center>";
        $this->email->message($msg);
        $this->email->set_crlf("\r\n");

        $result = $this->email->send();

        return $result;

        echo $this->email->print_debugger();
    }

}
