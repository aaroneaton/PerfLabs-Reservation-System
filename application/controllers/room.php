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

class Room extends MY_Controller {

  public $title = 'Rooms';

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
  
    // Check if user is administrator OR manager
    // If not, show 'no access' page

    // Else, query database for all rooms
    // Table should show Building and Room #

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
   * Displays a single room
   *
   */
  public function view() {
  
    // Check if user is an admin OR manager
    // If not, show 'no access' page
    //
    // Else, query database for room ID

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
   * Creates form to add new room
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
    // // // If record creation passes, redirect to room/index and set flash as successful
    // // //
    // // // Else, redirect to room/create and set flash to fail with error message

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
   * Creates form to edit room
   *
   */
  public function edit() {
  
    // Check if user is an admin OR manager
    // If not, show no access page
    //
    // Else, query database for the room ID
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, update the record in database
    // // // If record update passes, redirect to room/show and set flash as successful
    // // //
    // // // Else, redirect to room/edit and set flash to fail with error message

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
   * Removes room
   *
   */
  public function remove() {
  
    // Check if user is an admin
    // If not, show 'no access' page
    //
    // Else, remove room record from database

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
    
  
  }

}

