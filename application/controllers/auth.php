<?php

class Auth_test extends CI_Controller {

  public function __construct() {
  
    parent::__construct();
  
  }

  public function index() {
  
    $this->output->enable_profiler(TRUE);
    $data['auth'] = $this->session->userdata('auth');
    $this->load->view( 'auth_test', $data );
  
  }

  public function login() {
  
    $data['auth'] = $this->session->userdata('auth');

    if( empty($data['auth']) ) {
    
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

        redirect( '/auth_test', 'refresh');
        // header('Location: /auth_test', true, 302);
      }
      
    } else {

      $data['text'] = 'Hello World!';
      $this->output->enable_profiler(TRUE);
      $this->load->view( 'login', $data );

    }

  
  }

  public function logout() {
  
    $array_items = array(
      'ticketID' => '',
      'netID' => '',
      'uin' => '',
    );

    $this->session->unset_userdata( $array_items );
    
    redirect( '/auth_test', 'refresh');
  
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
