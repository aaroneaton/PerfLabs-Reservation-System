<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Auth Library
 *
 * Custom authentication library to extend CAS
 *
 */

class Auth_lib {

  public function __construct() {
  
    $this->ci =& get_instance();

    $this->ci->load->model( 'auth_model' );
    $this->ci->load->library( 'session');
    $this->ci->load->database();
  
  }

  public function is_logged_in() {
  
    $status = $this->ci->session->userdata( 'is_logged_in' );

    return $status;
  
  }

  public function login_out_link() {
  
    if ( $this->is_logged_in() ) {
    
      $anchor = array(
        'link' => 'auth/logout',
        'text' => 'Log Out',
      );
    
    } else {
    
      $anchor = array(
        'link' => 'auth/login',
        'text' => 'Log In',
      );
    
    }

    return $anchor;
  
  }

}
