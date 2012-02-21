<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MY_Controller extends CI_Controller {

  public function __construct() {
  
    parent::__construct();

    $this->load->library( 'auth_lib' );

    // Show CI Profiler. Remove in production.
    $this->output->enable_profiler(TRUE);
  }

  public function set_nav() {
  
    $session = $this->session->userdata( 'user_data' );

    $data['anchor'] = $this->auth_lib->login_out_link();

    $user_role = $session['user_role'];

    $data['user_id'] = $session['userID'];

    if ( $user_role >=40 ) {
    
      $nav = 'admin_nav';

    } else {
    
      $nav = 'user_nav';
    
    }

    $nav_view = $this->load->view( 'templates/' . $nav, $data, TRUE );

    return $nav_view;
  
  }

}
