<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * User Model
 *
 * Methods:
 * get_all_users - Retrieves all users and preps data for User controller
 *
 */

class User_model extends CI_Model {

  public function __construct() {
  
    parent::__construct();
  
  }

  function get_all_users() {
  
    $this->db->select( '*' );
    $this->db->from( 'user' );
    $this->db->join( 'user_meta', 'user.user_id = user_meta.user_id' );
    $this->db->join( 'user_role', 'user_meta.user_role_id = user_role.user_role_id' );

    $query = $this->db->get();

    $users = $query->result_array();

    return $users;
  
  }

  function create_user( $user ) {
  
    $this->db->set( 'net_id', $user['net_id'] );
    $this->db->insert( 'user' );

    $this->db->select( '*' );
    $this->db->from( 'user' );

    $user_id = $this->db->insert_id();
    $this->create_user_meta( $user_id, $user['user_role'] );
  
  }

  private function create_user_meta( $user_id, $user_role ) {
  
    $this->db->set( 'user_id', $user_id );
    $this->db->set( 'user_role_id', $user_role );
    return $this->db->insert( 'user_meta' );
  
  }

}
