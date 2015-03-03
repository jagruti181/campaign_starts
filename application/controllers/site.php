<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
        if($accesslevel==2)
        {
            $data[ 'facebook' ] = $this->session->userdata("facebook")=="";
            $data[ 'twitter' ] = $this->session->userdata("twitter")=="";
            if(!$data['twitter'] && !$data[ 'facebook' ])
            {
            }
            else
            {
                if($this->uri->segment(2)=="index")
                {
                }
                else
                {
                    redirect('/site/index/', 'refresh');
                }
            }
        }
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
            $data[ 'page' ] = 'dashboard';
//            $data['base_url'] = site_url("site/index");
//            $data['totalcompassadors'] = $this->user_model->gettotalcompassadors();
//            $data['admindash'] = $this->userpost_model->getadmindash();
            $data['title']='Admin Dashboard';
            $this->load->view('template',$data);
            
	}
}
?>