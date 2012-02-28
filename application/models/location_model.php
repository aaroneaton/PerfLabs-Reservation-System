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
  
  }

  function get_all_locations() {
  
    $this->db->select( '*' );
    $this->db->from ( 'equipment_location' );

    $query = $this->db->get();

    $locations = $query->result_array();

    return $locations;
  
  }

}
