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
