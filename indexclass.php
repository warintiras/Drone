<?php

class Obj {

  public $x;
  public $y;
  public $f;

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

} //end - class Obj {
?>
