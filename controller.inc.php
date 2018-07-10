<?php

class ObjController {

  function ObjController() {} //constructor

  function valid($x, $y, $f) { //Validate inputs.
    if ((empty($x) && is_numeric($x) == false) || (empty($y) && is_numeric($y) == false) || (empty($f))) { //At least one textbox is empty.
      return false;
    } else { //When textboxes are not empty, check if inputs are valid.
      if (($x >= 0 && $x <= 300) && ($y >= 0 && $y <= 300) && $this->chkF($f) == true) { //Valid inputs.
        session_start();
        $obj = new ObjModel($x, $y, $f);
        $_SESSION['obj'] = $obj;
        return true;
      } else return false; //Invalid inputs.
    }
  }

  function chkF($data) { //Check f.
    if ($data == "N" || $data == "S" || $data == "E" || $data == "W") return true;
    else return false;
  }
}

?>
