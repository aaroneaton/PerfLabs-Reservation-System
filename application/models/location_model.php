<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Location model
 *
 * Methods:
 *
 */

class Location_model extends CI_Model {

  public function __construct() {
  
    parent::__construct();

    $this->table = 'equipment_location';
  
  }

  function get_all_locations() {
  
    $this->db->select( '*' );
    $this->db->from ( $this->table );

    $query = $this->db->get();

    $locations = $query->result_array();

    return $locations;
  
  }

  function create_location( $l ) {
  
    $this->db->set( 'bldg', $l['building'] );
    $this->db->set( 'room', $l['room'] );
    $this->db->set( 'area', $l['area'] );

    $this->db->insert( $this->table );
  
  }

  function get_location( $l ) {
  
    $this->db->select( '*' );
    $this->db->from ( $this->table );
    $this->db->where( 'equipment_location_id', $l );

    $query = $this->db->get();

    $location = $query->row_array();

    return $location;
  
  }

  function edit_location( $l ) {
  
    $data = array(
      'bldg' => $l['building'],
      'room' => $l['room'],
      'area' => $l['area'],
    );

    $this->db->where( 'equipment_location_id', $l['location_id'] );
    $this->db->update( 'equipment_location', $data );
  
  }

}
