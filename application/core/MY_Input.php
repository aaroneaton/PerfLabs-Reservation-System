<?php

class My_Input extends CI_Input
{

  function _sanitize_globals()
  {
  
    $this->allow_get_array = TRUE;
    parent::_sanitize_globals();
  
  }

}
