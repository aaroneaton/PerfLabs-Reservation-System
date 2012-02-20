<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/*
 * Auth Controller
 *
 * Uses CAS_Client library (autoloaded)
 *
 * Methods:
 * index - Determines if user is logged in and redirects to proper method/controller
 * login - Determines again if user is logged in. Logs in user via CAS then redirects to Dashboard
 * logout - Erases session information to log out the user
 *
 */

class Auth extends CI_Controller {

  public function __construct() {
  
    parent::__construct();
  
    // Load the required classes for CAS_Client library
    $this->cas_client->registerAutoload();
  }

  /**
   * Method: index();
   *
   * Determines if the user is logged in.
   *
   * Logged in = Redirect to Dashboard
   *
   * Logged out = Redirect to auth/login
   *
   */
  public function index() {
  
    $this->output->enable_profiler(TRUE);
    $data['auth'] = $this->session->userdata('auth');
    $this->load->view( 'auth_test', $data );
  
  }

  /**
   * Method: login();
   *
   * Handles the login process with CAS. Redirects to Dashboard if already logged in.
   *
   */
  public function login() {
  
    $auth = $this->session->userdata('is_logged_in');

    if( empty($auth) ) {
    
      $version_3 = array(
        'serverHostname' => 'cas-dev.tamu.edu',
        'serverPort' => null,
        'serverURI' => '/cas',
        'serverSSL' => true,
        'version' => array('3', array('renew' => true)),
      );
      
      $cas_client = new CAS_Client($version_3);

      $ticket = $cas_client->login(CAS_Ticket::createFromGET(), false );

      if( $ticket === CAS_Client::REDIRECTED_FOR_LOGIN )
      {
        // Redirecting to the CAS login page
        header('Location: ' . $cas_client->getCASLoginService(), true, 302);
      }
      else
      {
        $ticketID = $ticket->getTicketID();
        $netID = $ticket->getNetID();
        $uin = $ticket->getUIN();

        $auth = array(
          'ticketID' => $ticketID,
          'netID' => $netID,
          'uin' => $uin,
        );
        $this->session->set_userdata($auth);

        $this->load->model( 'auth_model' );
        $query = $this->auth_model->validate();

        if( $query ) {
        
          $data = array(
            'is_logged_in' => TRUE,
          );
          $this->session->set_userdata( $data );
          redirect( '/dashboard/' );
        
        } else {
        
          show_error( 'You are not authorized to use this system' );
        
        }

      }
      
    } else {

      redirect( '/dashboard/', 'location', 302 );

    }

  
  }

  /**
   * Method: logout();
   *
   * Logs the user out by destroying the vital session data
   *
   */
  public function logout() {
  
    $this->session->sess_destroy();
    redirect( '/dashboard/' );
    
  
  }

  public function test() {
  
    $auth = array(
      'auth' => 'it works',
    );

    $this->session->set_userdata($auth);
    $this->output->enable_profiler(TRUE);
    $this->load->view('test');
  
  }

}
