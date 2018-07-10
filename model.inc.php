<?php

class ObjModel {

  public $x;
  public $y;
  public $f;

  public function ObjModel($x, $y, $f){
    $this->x = $x;
    $this->y = $y;
    $this->f = $f;
  }
  //Set value to x, y, and f
  public function setX($data) {
    $this->x=$data;
  }
  public function setY($data) {
    $this->y=$data;
  }
  public function setF($data) {
    $this->f=$data;
  }
  //Get value from x, y , and f
  public function getX() {
    return $this->x;
  }
  public function getY() {
    return $this->y;
  }
  public function getF() {
    return $this->f;
  }
}

?>
