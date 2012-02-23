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
    $session = $this->session->userdata( 'user_data' );

    if ( ! $session['user_role'] >= 40 || ! $session['userID'] == $user_id) {
    
      // If not, show 'no access' page
      show_error( 'You are not authorized to access this page' );
    
    } else {
      // Else, query database for user ID
    
      $body_data['user_data'] = $this->user_model->get_user_meta( $user_id );
    
    }
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'user/view', $body_data, TRUE );
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
    $session = $this->session->userdata( 'user_data' );
    if ( $session['user_role'] < 40 ) {
    
    // If not, show 'no access' page
      show_error( 'You are not authorized to access this page' );
    
    } else {
    
    // Else, move on to form
      $this->load->helper( array( 'form', 'url' ) );
      $this->load->library( 'form_validation' );

      // Setup form validation and errors
      $this->form_validation->set_message( 'is_unique', 'This user already exists' );
      $this->form_validation->set_error_delimiters( '<div class="row"><div class="span3 offset2"><div class="alert alert-error"><a class="close" data-dismiss="alert">x</a>', '</div></div></div>');
      $this->form_validation->set_rules( 'net_id', 'Net ID', 'required|is_unique[user.net_id]' );

      // Check if form validation has run
      if ( $this->form_validation->run() == FALSE ) {

        // If not, setup and show the form
        $body_data['form_attr'] = array( 'id' => 'new-user-form', 'class' => 'form-horizontal' );
        $body_data['form_fields'] = array(
          'net_id' => array(
            'name' => 'net_id',
            'id' => 'net_id',
            'placehoder' => 'TAMU NetID',
          ), // net_id
          'user_role' => array(
            'name' => 'user_role',
            'id' => 'user_role',
            'options' => array( // TODO - Pull options from DB
              '10' => 'Student',
              '20' => 'Studio User',
              '30' => 'Faculty/Staff',
              '40' => 'Manager',
              '50' => 'Adminstrator',
            ), // options
          ), // user_role
          'form_submit' => array(
            'name' => 'form_submit',
            'id' => 'form_submit',
            'value' => 'Create User',
            'class' => 'btn btn-primary',
          ), // form_submit
        ); // form_fields

        $layout_data['title'] = $this->title;
        $layout_data['navigation'] = $this->set_nav();
        $layout_data['body'] = $this->load->view( 'user/create', $body_data, TRUE );
        $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

        $this->load->view( 'layouts/main', $layout_data );
      
      } else {
      
        // Get post data from form
        $user = $this->input->post();

        // Pass $user along to User_model to create the user record
        $this->user_model->create_user( $user );

        $this->session->set_flashdata( 'success_message', 'User created successfully' );
        redirect( 'user' );
      
      }
    
    }
  
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
  public function remove( $user_id ) {

    // Check if user is an admin
    $session = $this->session->userdata( 'user_data' );
    if ( $session['user_role'] != 50 ) {

      show_error( 'You are not authorized to remove users.' );

    } else {
    
      $this->user_model->remove_user( $user_id );
      $this->session->set_flashdata( 'success_message', 'User has been removed successfully' );
      redirect( 'user' );
    
    }
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
