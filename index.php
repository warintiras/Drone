<?php

require_once('controller.inc.php');
require_once('model.inc.php');

$obj_controller = new ObjController();

$x = $_POST["x"];
$y = $_POST["y"];
$f = $_POST["f"];

if ($obj_controller->valid($x, $y, $f)) { //if true
//  header("Location:main.php?x=".$x."&y=".$y."&f=".$f);
  header("Location:main.php");
} else {
  header("Location:login.php?err=1");
}
?>
