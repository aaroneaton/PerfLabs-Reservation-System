<?php

class CAS_start {

  public function __construct() {
  
    $CI =& get_instance();
    $CI->cas_client->registerAutoload();
  
  }

}
