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
  
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
    
  
  }

}
