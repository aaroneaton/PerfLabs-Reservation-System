<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Location Controller
 *
 * Methods:
 * index - Lists all storage locations
 * create - Creates form to add new storage location
 * view - Displays a single storage location
 * edit - Creates form to edit storage location
 * remove - Removes storage location
 *
 */

class Location extends MY_Controller {

  public $title = 'Storage Locations';

  public function __construct() {
  
    parent::__construct();

    $this->load->model( 'location_model' );
  
  }

  /**
   * Method: index();
   * @access Administrator, Manager
   *
   * Lists all storage locations
   *
   */
  public function index() {
  
    // Check if user is administrator
    $session = $this->session->userdata( 'user_data' );
    if ( $session['user_role'] < 40 ) {

      // If not, show 'no access' page
      show_error( 'You are not authorized to access this page' );
    
    } else {
    
      // Else, query database for all users
      $body_data['locations'] = $this->location_model->get_all_locations();
    
    }

    // Table should only show Name, email, and role
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'location/index', $body_data, TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /** 
   * Method: view();
   * @access Administrator, Manager
   *
   * Displays a single storage location
   *
   */
  public function view() {
  
    // Check if user is an admin OR manager
    // If not, show 'no access' page
    //
    // Else, query database for location ID

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
   * Creates form to add new storage location
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
    // // // If record creation passes, redirect to location/index and set flash as successful
    // // //
    // // // Else, redirect to location/create and set flash to fail with error message

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
   * Creates form to edit storage location
   *
   */
  public function edit() {
  
    // Check if user is an admin OR manager
    // If not, show no access page
    //
    // Else, query database for the location ID
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, update the record in database
    // // // If record update passes, redirect to location/show and set flash as successful
    // // //
    // // // Else, redirect to location/edit and set flash to fail with error message

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
   * Removes storage location
   *
   */
  public function remove() {
  
    // Check if user is an admin
    // If not, show 'no access' page
    //
    // Else, remove location record from database

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
    
  
  }

}


