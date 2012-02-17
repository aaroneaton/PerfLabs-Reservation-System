<?php

class Auth_model extends CI_Model {

  function validate() {
  
    $query = $this->db->get_where( 'user', array( 'net_id' => $this->session->userdata( 'netID' ) ) );

    if( $query->num_rows == 1 ) {
    
      return true;
    
    }
  
  }

}
