<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Room Controller
 *
 * Methods:
 * index - Lists all rooms
 * create - Creates form to add new room
 * view - Displays a single room
 * edit - Creates form to edit room
 * remove - Removes room
 *
 */

class room extends CI_Controller {

  public function __construct() {
  
    parent::__construct();
  
  }

  /**
   * Method: index();
   * @access Administrator, Manager
   *
   * Lists all rooms
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
   * Creates form to add new room
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
   * Displays a single room
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
   * Creates form to edit room
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
   * Removes room
   *
   */
  public function remove() {
  
    $this->load->view( 'templates/header');
    $this->load->view( 'error/empty_method');
    $this->load->view( 'templates/footer');
    $this->output->enable_profiler(TRUE);
    
  
  }

}

