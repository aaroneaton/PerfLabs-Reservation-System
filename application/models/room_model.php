<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Room model
 *
 * Methods:
 *
 */

class Room_model extends CI_Model {

  public function __construct() {
  
    parent::__construct();

    $this->table = 'room';
  
  }

  function get_all_rooms() {
  
    $this->db->select( '*' );
    $this->db->from ( $this->table );

    $query = $this->db->get();

    $rooms = $query->result_array();

    return $rooms;
  
  }

  function create_room( $r ) {
  
    $this->db->set( 'bldg', $r['building'] );
    $this->db->set( 'number', $r['room'] );

    $this->db->insert( $this->table );
  
  }

  function get_room( $r ) {
  
    $this->db->select( '*' );
    $this->db->from ( $this->table );
    $this->db->where( 'room_id', $r );

    $query = $this->db->get();

    $room = $query->row_array();

    return $room;
  
  }

  function edit_room( $r ) {
  
    $data = array(
      'bldg' => $r['building'],
      'room' => $r['room'],
    );

    $this->db->where( 'room_id', $r['room_id'] );
    $this->db->update( 'room', $data );
  
  }

  function remove_room( $r ) {
  
    $this->db->where( 'room_id', $r );
    $this->db->delete( 'room' );
  
  }

}
