<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Studio_guest Controller
 *
 * Methods:
 * index - Lists all studio guests
 * create - Creates form to add new studio guest
 * view - Displays a single studio guest
 * edit - Creates form to edit studio guest
 * remove - Removes studio guest
 *
 */

class Studio_guest extends CI_Controller {

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
    
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
  }

  /** 
   * Method: show();
   * @access Administrator, Manager
   *
   * Displays a single studio guest
   *
   */
  public function show() {
  
    // Check if user is an admin OR manager
    // If not, show 'no access' page
    //
    // Else, query database for studio guest ID
    
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
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

    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
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
 
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
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
    
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
    
  
  }

}


