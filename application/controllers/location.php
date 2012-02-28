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
  public function view( $location ) {
  
    // Check if user is an admin OR manager
    $session = $this->session->userdata( 'user_data' );
    if ( $session['user_role'] < 40 ) {
    
      show_error( 'You are not authorized to access this page' );
    
    } else {
    
      $body_data['location']= $this->location_model->get_location( $location );
    
    }
    // If not, show 'no access' page
    //
    // Else, query database for location ID

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'location/view', $body_data, TRUE );
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
    $session = $this->session->userdata( 'user_data' );
    if ( $session['user_role'] < 40 ) {
    
      // If not, show 'no access' page
      show_error( 'You are not authorized to access this page' );
    
    } else {
    
      // Else, move on to form
      $this->load->helper( array( 'form', 'url' ) );
      $this->load->library( 'form_validation' );

      // Setup form validation and errors
      $this->form_validation->set_rules( 'building', 'Building', 'required' );
      $this->form_validation->set_rules( 'room', 'Room', 'required' );
      $this->form_validation->set_rules( 'area', 'Area', 'required' );

      // Check if form validation has run
      if ( $this->form_validation->run() == FALSE ) {
      
        // If not, setup and show the form
        $body_data['form_attr'] = array( 'id' => 'new-location-form', 'class' => 'form-horizontal' );
        $body_data['form_fields'] = array(
          'building' => array(
            'name' => 'building',
            'id' => 'building',  
          ),
          'room' => array(
            'name' => 'room',
            'id' => 'room',
          ),
          'area' => array(
            'name' => 'area',
            'id' => 'area',
          ),
          'form_submit' => array(
            'name' => 'form-submit',
            'id' => 'form-submit',
            'class' => 'btn btn-primary',
            'value' => 'Create Location',
          ),
        );

        $layout_data['title'] = $this->title;
        $layout_data['navigation'] = $this->set_nav();
        $layout_data['body'] = $this->load->view( 'location/create', $body_data, TRUE );
        $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

        $this->load->view( 'layouts/main', $layout_data );
      
      } else {
      
        // Get the form input
        $location = $this->input->post();

        // Create the location in the database
        $this->location_model->create_location( $location );

        // Set the success message and redirect to index
        $this->session->set_flashdata( 'success_message', 'Location created successfully' );
        redirect( 'location' );
      
      }
    
    }
  
  }

  /**
   * Method: edit();
   * @access Administrator, Manager
   *
   * Creates form to edit storage location
   *
   */
  public function edit( $location ) {
  
    // Check if user is an admin OR manager
    $session = $this->session->userdata( 'user_data' );
    if ( $session['user_role'] < 40 ) {
    
      // If not, show 'no access' page
      show_error( 'You are not authorized to access this page' );
    
    } else {
    
      // Get current location information
      $current = $this->location_model->get_location( $location );

      // Else, move on to form
      $this->load->helper( array( 'form', 'url' ) );
      $this->load->library( 'form_validation' );

      // Setup form validation and errors
      $this->form_validation->set_rules( 'building', 'Building', 'required' );
      $this->form_validation->set_rules( 'room', 'Room', 'required' );
      $this->form_validation->set_rules( 'area', 'Area', 'required' );

      // Check if form validation has run
      if ( $this->form_validation->run() == FALSE ) {
      
        // If not, setup and show the form
        $body_data['form_attr'] = array( 'id' => 'new-location-form', 'class' => 'form-horizontal' );
        $body_data['hidden'] = array( 'location_id' => $location );
        $body_data['form_fields'] = array(
          'building' => array(
            'name' => 'building',
            'id' => 'building',  
            'value' => set_value( 'building', $current['bldg'] ),
          ),
          'room' => array(
            'name' => 'room',
            'id' => 'room',
            'value' => set_value( 'room', $current['room'] ),
          ),
          'area' => array(
            'name' => 'area',
            'id' => 'area',
            'value' => set_value( 'area', $current['area'] ),
          ),
          'form_submit' => array(
            'name' => 'form-submit',
            'id' => 'form-submit',
            'class' => 'btn btn-primary',
            'value' => 'Edit Location',
          ),
        );

        $layout_data['title'] = $this->title;
        $layout_data['navigation'] = $this->set_nav();
        $layout_data['body'] = $this->load->view( 'location/edit', $body_data, TRUE );
        $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

        $this->load->view( 'layouts/main', $layout_data );
      
      } else {
      
        // Get the form input
        $location = $this->input->post();

        // Create the location in the database
        $this->location_model->edit_location( $location );

        // Set the success message and redirect to index
        $this->session->set_flashdata( 'success_message', 'Location updated successfully' );
        redirect( 'location' );
      
      }
    
    }
  
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


