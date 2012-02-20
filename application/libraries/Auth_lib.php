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
    
      $link = '"auth/logout"';
      $text = '"Log Out"';
    
    } else {
    
      $link = 'auth/login';
      $text = 'Log In';
    
    }

    $anchor = ' echo anchor(' . $link . ', ' . $text . ')';

    return $anchor;
  
  }

  public function is_admin() {
  
  
  
  }

  public function is_manager() {
  
  
  
  }

  public function is_faculty_staff() {
  
  
  
  }

  public function is_studio_user() {
  
  
  
  }

  public function is_student() {
  
  
  
  }

}
