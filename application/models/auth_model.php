<?php

class Auth_model extends CI_Model {

  function validate() {
  
    $query = $this->db->get_where( 'user', array( 'net_id' => $this->session->userdata( 'netID' ) ) );

    if( $query->num_rows == 1 ) {
    
      return true;
    
    }
  
  }

  function get_user_session() {
  
    $this->db->select( '*' );
    $this->db->from( 'user' );
    $this->db->where( 'net_id', $this->session->userdata( 'netID' ) );
    $this->db->join( 'user_meta', 'user.user_id = user_meta.user_id' );

    $query = $this->db->get();

    $row = $query->row();

    $result = array(
      'userID' => $row->user_id,
      'netID' => $row->net_id,
      'firstname' => $row->first_name,
      'lastname' => $row->last_name,
      'user_role' => $row->user_role_id,
    );

    return $result;
  
  }

  function get_user_role() {
  
    $this->db->select( '*' );
    $this->db->from( 'user' );
    $this->db->where( 'net_id', $this->session->userdata( 'netID' ) );
    $this->db->join( 'user_meta', 'user.user_id = user_meta.user_id' );

    $query = $this->db->get();

    $row = $query->row();

    return $row->user_role_id;
  
  }

}
