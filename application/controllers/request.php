<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Request Controller
 *
 * Methods:
 * index - Lists all requests
 * create - Creates form to add new request
 * view - Displays a single request
 * edit - Creates form to edit request
 * checkout - Creates form to checkout equipment
 * checkin - Creates form to checkin equipment
 * cancel - Cancels a request
 *
 */

class Request extends MY_Controller {

  public $title = 'Storage Locations';

  public function __construct() {
  
    parent::__construct();
  
  }

  /**
   * Method: index();
   * @access Administrator, Manager
   *
   * Lists all requests
   *
   */
  public function index() {
  
    // Check if user is administrator OR manager
    // If not, show 'no access' page

    // Else, query database for all requests
    // Table should show date, time, requestor, request type

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /** 
   * Method: view();
   * @access Administrator, Manager, Users (own request only)
   *
   * Displays a single request
   *
   */
  public function view() {
  
    // Check if user is an admin OR manager, OR user ID = request.user_id
    // If not, show 'no access' page
    //
    // Else, query database for request ID

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /**
   * Method:create();
   * @access All
   *
   * Creates form to add new request
   *
   */
  public function create() {
  
    // Check if user is logged in
    // If not, show 'no access' page
    //
    // Else, move on to form
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, create the records in database
    // // // If record creation passes, redirect to dashboard/index and set flash as successful
    // // //
    // // // Else, redirect to request/create and set flash to fail with error message

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }


  /**
   * Method: edit();
   * @access Administrator, Manager, Users (own request only)
   *
   * Creates form to edit request
   *
   */
  public function edit() {
  
    // Check if user is admin OR manager OR user ID = request.user_id
    // If not, show no access page
    //
    // Else, query database for the request ID
    //
    // // Check if form validation has run
    // // If not, load the form view
    // //
    // // Else, update the record in database
    // // // If record update passes, redirect to request/view and set flash as successful
    // // //
    // // // Else, redirect to request/edit and set flash to fail with error message

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /**
   * Method: checkout()
   * @access Administrator, Manager
   *
   * Creates form to checkout equipment
   *
   */
  public function checkout() {

    // Check if user is admin OR manager
    // If not, show no access page
    //
    // Else, update equipment.user_id to request.user_id, set request.status = In Progress
    // Create equipment_history record for each item
    // // datetime = now();
    // // action = Checked Out
    // // equipment_id = equipment.equipment_id
    // // user_id = request.user_id
    // // request_id = request.request_id
    //
    // Redirect to request/index
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /**
   * Method: checkin();
   * @access Administrator, Manager
   *
   * Creates form to checkin equipment
   *
   */
  public function checkin() {
  
    // Check if user is admin OR manager
    // If not, show no access page
    //
    // Else, update equipment.user_id to request.user_id, set request.status = Completed
    // Create equipment_history record for each item
    // // datetime = now();
    // // action = Checked In
    // // equipment_id = equipment.equipment_id
    // // user_id = request.user_id
    // // request_id = request.request_id
    //
    // Redirect to request/index

    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

  /**
   * Method: accept();
   * @access Administrator
   *
   * Accepts the request
   *
   */
  public function accept() {
  
    // Check if user is admin
    // If not, show 'no access' page
    //
    // Else, update request.status = Accepted
    // Create request_comment
    // // datetime = now();
    // // comment = Request status changed to Accepted
    // // user_id = user ID
    // // request_id = request.request_id
    // Send email to requestor
    // Redirect to request/index with flashdata set to accepted
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );

  }

  /**
   * Method: deny();
   * @access Administrator
   *
   * Denies the request
   *
   */
  public function deny() {
  
    // Check if user is admin
    // If not, show 'no access' page
    //
    // Else, update request.status = Denied
    // Create request_comment
    // // datetime = now();
    // // comment = Request status changed to Denied
    // // user_id = user ID
    // // request_id = request.request_id
    // Send email to requestor
    // Redirect to request/index with flashdata set to denied
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  }

  /**
   * Method: cancel();
   * @access Administrator, Users (own request only)
   *
   * Cancels request
   *
   */
  public function cancel() {

    // Check if user is admin OR user ID = equipment.user_id
    // If not, show no access page
    //
    // Else, update request.status = Cancelled
    // Create request_comment
    // // datetime = now();
    // // comment = Request was cancelled by user_id
    // // user_id = user ID
    // // request_id = request.request_id
    // Redirect to request/view with flashdata set to cancelled
  
    $layout_data['title'] = $this->title;
    $layout_data['navigation'] = $this->set_nav();
    $layout_data['body'] = $this->load->view( 'error/empty_method', '', TRUE );
    $layout_data['footer'] = $this->load->view( 'templates/footer', '', TRUE );

    $this->load->view( 'layouts/main', $layout_data );
  
  
  }

}
