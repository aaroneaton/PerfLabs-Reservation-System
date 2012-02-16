<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Equipment Controller
 *
 * Methods:
 * index - Lists entire inventory
 * create - Creates form to add new equipment
 * view - Displays a single equipment item
 * edit - Creates form to edit equipment item
 * remove - Removes equipment item from inventory
 *
 */

class Equipment extends CI_Controller {

  public function __construct() {
  
    parent::__construct();
  
  }

  /**
   * Method: index();
   * @access Administrator, Manager
   *
   * Lists entire inventory
   *
   */
  public function index() {
  
    // Check if user is administrator OR manager
    // If not, show 'no access' page

    // Else, query database for all equipment
    // Table should show Custom ID, Name, Qty, Status, User ID

    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
  }

  /** 
   * Method: view();
   * @access Administrator, Manager
   *
   * Displays a single equipment item
   *
   */
  public function view() {
  
    // Check if user is an admin OR manager
    // If not, show 'no access' page
    //
    // Else, query database for equipment ID

    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
  }

  /**
   * Method: create();
   * @access Administrator, Manager
   *
   * Creates form to add new equipment
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
    // // // If record creation passes, redirect to equipment/index and set flash as successful
    // // //
    // // // Else, redirect to equipment/create and set flash to fail with error message

    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
  }


  /**
   * Method: edit();
   * @access Administrator, Manager
   *
   * Creates form to edit equipment item
   *
   */
  public function edit() {
  
    // Check if user is an admin OR manager
    // If not, show no access page
    //
    // Else, query database for the equipment ID
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, update the record in database
    // // // If record update passes, redirect to equipment/show and set flash as successful
    // // //
    // // // Else, redirect to equipment/edit and set flash to fail with error message

    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  
  }

  /**
   * Method: seen();
   * @access Administrator, Manager
   *
   * Creates equipment history entry to update last seen date
   *
   */
  public function seen() {
  
    // Check if user is an admin OR manager
    // If not, show 'no access' page
    //
    // Else, create equipment_history record
    // // datetime = now();
    // // action = Seen
    // // equipment_id = $equipment_id
    // // user_id = user ID
    // Redirect to equipment/index with flashdata set to Seen

    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  }

  /**
   * Method: remove();
   * @access Administrator
   *
   * Removes equipment item from inventory
   *
   */
  public function remove() {
  
    // Check if user is an admin
    // If not, show 'no access' page
    //
    // Else, remove equipment record from database

    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
    
  
  }

}
