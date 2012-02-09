<?php

/*
 * The dashboard displays all of the information to the user
 */

class Dashboard extends CI_Controller {

  public function __construct() {
  
    parent::__construct();
  
  }

  public function index() {
  
    $data[ 'title' ] = 'Dashboard';

    $this->load->view( 'templates/header', $data );
    $this->load->view( 'dashboard/user', $data );
    $this->load->view( 'templates/footer' );
  
  }

}
