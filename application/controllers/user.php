<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * User Controller
 *
 * Methods:
 * index - Shows a list of all users in the application
 * show - Displays the selected user's profile
 * create - Creates form to add user
 * edit - Creates form to edit the user profile
 * remove - Removes the user completely
 *
 */

class User extends CI_Controller {

  public function __construct() {
  
    parent::__construct();
  
  }

  /**
   * Method: index();
   * @access Administrator
   *
   * Shows a list of all users in the application
   *
   */
  public function index() {

    // Check if user is administrator
    // If not, show 'no access' page

    // Else, query database for all users
    // Table should only show Name, email, and role
  
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
  
  }

  /**
   * Method: show();
   * @access Administrator, User (own profile only)
   *
   * Displays the selected user's profile
   *
   */
  public function show() {

    // Check if user is an admin OR user ID = current user ID
    // If not, show 'no access' page
    //
    // Else, query database for user ID
  
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
  
    $this->output->enable_profiler(TRUE);
  
  }

  /**
   * Method: create();
   * @access Administrator
   *
   * Creates form to add user
   *
   */
  public function create() {

    // Check if user is an admin
    // If not, show 'no access' page
    //
    // Else, move on to form
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, create the records in database
    // // // If record creation passes, redirect to user/index and set flash as successful
    // // //
    // // // Else, redirect to user/create and set flash to fail with error message
  
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
  
    $this->output->enable_profiler(TRUE);
  
  }

  /** Method: edit();
   * @access Administrator
   *
   * Creates form to edit the user profile
   *
   */
  public function edit() {
  
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
  
  
    $this->output->enable_profiler(TRUE);
  }

  /**
   * Method: remove();
   * @access Administrator
   *
   * Removes the user completely from the database
   *
   */
  public function remove() {
  
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
  
  
    $this->output->enable_profiler(TRUE);
  }

}
