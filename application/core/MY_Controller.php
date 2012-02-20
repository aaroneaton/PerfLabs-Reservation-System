<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MY_Controller extends CI_Controller {

  public function __construct() {
  
    parent::__construct();

    $this->load->library( 'auth_lib' );

    $data['link'] = $this->auth_lib->login_out_link();
  
    $this->data['test'] = 'TESTING!';
  }

  public function nav_links() {
  
    
  
  }

}
