<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * User Controller
 *
 * Methods:
 * index - Shows a list of all users in the application
 * view - Displays the selected user's profile
 * create - Creates form to add user
 * edit - Creates form to edit the user profile
 * remove - Removes the user completely
 *
 */

class User extends MY_Controller {

  public $title = 'Users';

  public function __construct() {
  
    parent::__construct();

    $this->load->model( 'user_model' );
  
  }

  /**
   * Method: index();
   * @access Administrator, Manager
   *
   * Shows a list of all users in the application
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
      $body_data['users'] = $this->user_model->get_all_users();
    
    }

    // Table should only show Name, email, and role
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'user/index', $body_data, TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  }

  /**
   * Method: view();
   * @access Administrator, User (own profile only)
   *
   * Displays the selected user's profile
   *
   * @param int UserID
   */
  public function view( $user_id ) {

    // Check if user is an admin OR user ID = current user ID
    // If not, show 'no access' page
    //
    // Else, query database for user ID
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
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
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  }

  /** Method: edit();
   * @access Administrator, User ( own profile only )
   *
   * Creates form to edit the user profile
   *
   * @param int UserID
   */
  public function edit() {

    // Check if user is an admin OR user ID = current user ID
    // If not, show no access page
    //
    // Else, query database for the user ID
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, update the record in database
    // // // If record update passes, redirect to user/show and set flash as successful
    // // //
    // // // Else, redirect to user/edit and set flash to fail with error message
  
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
   * Removes the user completely from the database
   *
   * @param int UserID
   *
   */
  public function remove() {

    // Check if user is an admin
    // If not, show 'no access' page
    //
    // Else, remove user record from database
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  }

}
