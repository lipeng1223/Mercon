<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * library using dompdf
 */

/* require_once(dirname(__FILE__) . '/dompdf/dompdf_config.inc.php');

class Pdf extends DOMPDF
{
	protected function ci()
	{
		return get_instance();
	}

	public function load_view($view, $data = array())
	{
		$html = $this->ci()->load->view($view, $data, TRUE);

		$this->load_html($html);
	}
} */

/**
 * library using tcpdf
 */

require_once(dirname(__FILE__) . '/tcpdf/tcpdf.php');

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct('P', 'mm', 'A4', true, 'UTF-8', false);
    }
    
    protected function ci()
    {
        return get_instance();
    }
    
    /**
     *set custome header
     *this is override function of tcpdf
     **/
    public function Header() {
        $image_file = base_url()."assets/images/logo/logo.png";
        
        $headerdata = $this->getHeaderData();
        $this->y = $this->header_margin;
        $this->x = $this->w - $this->original_rMargin - 30;
        
        $imgy = $this->y;
        
        $this->Image($image_file, '', '', $headerdata['logo_width']);
        
        $this->SetLineStyle(array('width' => 0.85 / $this->k, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $headerdata['line_color']));
        
        $this->Line(10, 15, 200, 15);
    }
    
    /**
     * cover page
     */
    public function AddCover($image_file, $txt) {    
        $this->Image($image_file, 30, 50, 150);
        $this->SetFont('times', 'B', 22);
        $this->Write(150, $txt, '', 0, 'C', true, 0, false, false, 0);
    }
    
    /**
     * load view page
     * @param unknown $view
     * @param unknown $data
     */
    public function load_view($view, $data = array())
    {
        $html = $this->ci()->load->view($view, $data, TRUE);
    
        //$this->AddPage();
        $this->writeHTML($html, true, false, true, false, 'J');
    }
}