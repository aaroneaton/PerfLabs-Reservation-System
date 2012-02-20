<?php

/*
 * The dashboard displays all of the information to the user
 */

class Dashboard extends MY_Controller {

  public function __construct() {
  
    parent::__construct();

    $this->load->model( 'auth_model' );
    $this->load->library( 'auth_lib' );
  
  }

  public function index() {
  
    $data[ 'title' ] = 'Dashboard';

    $data[ 'anchor' ] = $this->auth_lib->login_out_link();

    $this->load->view( 'templates/header', $data );
    $this->load->view( 'dashboard/user', $data );
    $this->load->view( 'templates/footer' );
    $this->output->enable_profiler(TRUE);
  
  }

}
