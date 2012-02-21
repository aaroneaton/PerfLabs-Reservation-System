<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Studio_guest Controller
 *
 * Methods:
 * index - Lists all studio guests
 * view - Displays a single studio guest
 * create - Creates form to add new studio guest
 * edit - Creates form to edit studio guest
 * remove - Removes studio guest
 *
 */

class Studio_guest extends MY_Controller {

  public $title = 'Studio Guests';

  public function __construct() {
  
    parent::__construct();
  
  }

  /**
   * Method: index();
   * @access Administrator, Manager
   *
   * Lists all studio guests
   *
   */
  public function index() {
  
    // Check if user is administrator
    // If not, show 'no access' page

    // Else, query database for all studio guests
    // Table should show Name & TAMU Relationship
    
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /** 
   * Method: view();
   * @access Administrator, Manager
   *
   * Displays a single studio guest
   *
   */
  public function view() {
  
    // Check if user is an admin OR manager
    // If not, show 'no access' page
    //
    // Else, query database for studio guest ID
    
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /**
   * Method: create();
   * @access Administrator, Manager
   *
   * Creates form to add new studio guest
   *
   */
  public function create() {
  
    // Check if user is an admin OR manager
    // If not, show 'no access' page
    //
    // Else, move on to form
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, create the records in database
    // // // If record creation passes, redirect to studio_guest/index and set flash as successful
    // // //
    // // // Else, redirect to studio_guest/create and set flash to fail with error message

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /**
   * Method: edit();
   * @access Administrator, Manager
   *
   * Creates form to edit studio guest
   *
   */
  public function edit() {
  
    // Check if user is an admin OR manager
    // If not, show no access page
    //
    // Else, query database for the studio guest ID
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, update the record in database
    // // // If record update passes, redirect to studio_guest/show and set flash as successful
    // // //
    // // // Else, redirect to studio_guest/edit and set flash to fail with error message
 
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /**
   * Method: remove();
   * @access Administrator
   *
   * Removes studio guest
   *
   */
  public function remove() {
  
    // Check if user is an admin
    // If not, show 'no access' page
    //
    // Else, remove studio guest record from database
    
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
    
  
  }

}


