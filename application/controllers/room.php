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
	
	$this->load->model( 'room_model' );
  
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
	$session = $this->session->userdata( 'user_data' );
	if ( $session['user_role'] < 40 ) {
	
    // If not, show 'no access' page
		show_error( 'You are not authorized to access this page' );
		
	} else {
	
		// Else, query database for all rooms
		$body_data['rooms'] = $this->room_model->get_all_rooms();
	
	}

    // Table should show Building and Room #

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'room/index', $body_data, TRUE );
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
  public function view( $room ) {
  
    // Check if user is an admin OR manager
	$session = $this->session->userdata( 'user_data' );
	if ( $session['user_role'] < 40 ) {
    
		// If not, show 'no access' page
		show_error( 'You are not authorized to access this page' );
	
	} else {
    // Else, query database for room ID
		$body_data['room'] = $this->room_model->get_room( $room );

	}
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'room/view', $body_data, TRUE );
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
	$session = $this->session->userdata( 'user_data' );
	if ( $session['user_role'] < 40 ) {
		// If not, show 'no access' page
		show_error( 'You are not authorized to access this page');
	
	} else {
		// Else, move on to form
		$this->load->helper( array( 'form', 'url' ) );
		$this->load->library( 'form_validation' );
		
		// Setup form validation & errors
		$this->form_validation->set_rules( 'building', 'Building', 'required' );
		$this->form_validation->set_rules( 'room', 'Room', 'required' );
		
		// Check if form validation has run
		if ( $this->form_validation->run() == FALSE ) {
		
			// If not, load the form view
			$body_data['form_attr'] = array( 'id' => 'new-room-form', 'class' => 'form-horizontal' );
			$body_data['form_fields'] = array(
				'building' => array(
					'name' => 'building',
					'id' => 'building',
				),
				'room' => array(
					'name' => 'room',
					'id' => 'room',
				),
				'form_submit' => array(
					'name' => 'form-submit',
					'id' => 'form-submit',
					'class' => 'btn btn-primary',
					'value' => 'Create Room',
				),
			);
			
			$layout_data['title'] = $this->title;
			$layout_data['navigation'] = $this->set_nav();
			$layout_data['body'] = $this->load->view( 'room/create', $body_data, TRUE );
			$layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );
			
			$this->load->view( 'layouts/main', $layout_data );
		
		} else {
		
			// Get the form input
			$room = $this->input->post();

			// Create the room in the database
			$this->room_model->create_room( $room );

			// Set the success message and redirect to index
			$this->session->set_flashdata( 'success_message', 'Room created successfully' );
			redirect( 'room' );
		
		}

	}  
  
  }


  /**
   * Method: edit();
   * @access Administrator, Manager
   *
   * Creates form to edit room
   *
   */
  public function edit( $room ) {
  
        // Check if user is an admin OR manager
	$session = $this->session->userdata( 'user_data' );
	if ( $session['user_role'] < 40 ) {
		// If not, show 'no access' page
		show_error( 'You are not authorized to access this page');
	
	} else {
		
		// Get current room information
		$current = $this->room_model->get_room( $room );
		
		// Else, move on to form
		$this->load->helper( array( 'form', 'url' ) );
		$this->load->library( 'form_validation' );
		
		// Setup form validation & errors
		$this->form_validation->set_rules( 'building', 'Building', 'required' );
		$this->form_validation->set_rules( 'room', 'Room', 'required' );
		
		// Check if form validation has run
		if ( $this->form_validation->run() == FALSE ) {
		
			// If not, load the form view
			$body_data['form_attr'] = array( 'id' => 'edit-room-form', 'class' => 'form-horizontal' );
			$body_data['hidden'] = array( 'room_id' => $room );
			$body_data['form_fields'] = array(
				'building' => array(
					'name' => 'building',
					'id' => 'building',
					'value' => set_value( 'building', $current['bldg'] ),
				),
				'room' => array(
					'name' => 'room',
					'id' => 'room',
					'value' => set_value( 'room', $current['number'] ),
				),
				'form_submit' => array(
					'name' => 'form-submit',
					'id' => 'form-submit',
					'class' => 'btn btn-primary',
					'value' => 'Edit Room',
				),
			);
			
			$layout_data['title'] = $this->title;
			$layout_data['navigation'] = $this->set_nav();
			$layout_data['body'] = $this->load->view( 'room/edit', $body_data, TRUE );
			$layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );
			
			$this->load->view( 'layouts/main', $layout_data );
		
		} else {
		
			// Get the form input
			$room = $this->input->post();

			// Create the room in the database
			$this->room_model->edit_room( $room );

			// Set the success message and redirect to index
			$this->session->set_flashdata( 'success_message', 'Room created successfully' );
			redirect( 'room' );
		
		}

	} 
  
  
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

