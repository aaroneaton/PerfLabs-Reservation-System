<?php

/*
 * The dashboard displays all of the information to the user
 */

class Dashboard extends MY_Controller {

  public $title = 'Dashboard';
  public function __construct() {
  
    parent::__construct();

  
  }

  public function index() {
  

    $session = $this->session->userdata( 'user_data' );
    $body_data['user_name'] = $session['firstname'];

    $footer_data = 'Test';

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'dashboard/user', $body_data, TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', $footer_data, TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  }

}
