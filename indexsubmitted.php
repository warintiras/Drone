<?php

include 'indexclass.php';

$obj = new Obj;

if (isset($_POST['submit'])) {
  $x = $_POST["x"];
  $y = $_POST["y"];
  $f = $_POST["f"];

  //Check inputs
  if ((empty($x) && is_numeric($x) == false) || (empty($y) && is_numeric($y) == false) || (empty($f))) { //At least one textbox is empty.
    $errMsg = "* Please enter X, Y, and F."; //At least one textbox is empty.
  }
  else { //Textboxes are not empty.
    if (($x >= 0 && $x <= 300) && ($y >= 0 && $y <= 300) && chkF($f) == true) { //Valid inputs.
      $obj->setX($x);
      $obj->setY($y);
      $obj->setF($f);
    }
    else { //Invalid inputs.
      $errMsg = "* Enter a number between 0-300 for X and Y, and N, S, W, or E for F.";
    }
  } // end - if ((empty($x) && is_numeric...
} // end - if (isset(....))

function chkF($data) { //Check F.
  if ($data == "N" || $data == "S" || $data == "E" || $data == "W") {
    return true;
  } else {
    return false;
  }
}
?>

<script>
var myPlayer; //component

//Inputs from textboxes from object. Global.
x = "<?php echo $obj->getX() ?>";
y = "<?php echo $obj->getY() ?>";
f = "<?php echo $obj->getF() ?>";

function createCanvas() {
  myCanvas.start();
}

function createComponent() { //icon
  if (x != "" && y != "" && f != "") { //Create component if all textboxes are not empty.
    myPlayer = new component(32, 32, Number(x), Number(y));
  }
}

createComponent();

var myCanvas = { //object
  canvas : document.createElement("canvas"),

  start : function () {
    this.canvas.width = 300;
    this.canvas.height = 300;
    this.context = this.canvas.getContext("2d");  //drawing object
    document.body.insertBefore(this.canvas, document.body.childNodes[0]);
    this.frameNo = 0;
    this.interval = setInterval(updateCanvas,20);
  },

  stop: function () {
    clearInterval(this.interval);
  },

  clear : function () {
    this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
  }
 }

function component(width, height, x, y){
   this.width = width;
   this.height = height;
   this.x = x;
   this.y = y;

   this.speed = 0;
   this.moveAngle = 0;

   //Direction icon is facing.
   /* When F is W, E, or N, the icon will not move in a straight line because of the angle.
      If we use a square as an image and change angle to 1, -1, and 2 when F is W, E, or N,
      the image will then move in a straight line. */
   if (f == "W") { this.angle = 1.5; }
   else if (f == "E") { this.angle = -1.5; }
   else if (f == "N") { this.angle = -3.1; }
   else { this.angle = 0; } // f == "S"

   this.update = function () {
     ctx = myCanvas.context;
     ctx.save();
     ctx.translate(this.x, 300-this.y); // 0,0 is at the bottom, left corner
     ctx.rotate(this.angle);
     ctx.drawImage(document.getElementById("icon"), this.width/-2, this.height/-2);
     ctx.restore();
   }
   this.newPos = function () {
     this.angle += this.moveAngle * (90 * Math.PI/180);
     this.x += this.speed * Math.sin(this.angle);
     this.y -= this.speed * Math.cos(this.angle);

     //Stop before going over the edge.
     if (this.x > (myCanvas.canvas.width - this.width/2)) { //x axis, right
         this.x = (myCanvas.canvas.width - this.width/2);
     }
     if (this.x < this.width/2) { //x axis, left
         this.x = this.width/2;
     }
     if (this.y > (myCanvas.canvas.height - this.height/2)) { //y axis, top
         this.y = (myCanvas.canvas.height - this.height/2);
     }
     if (this.y < this.height/2) { //y axis, bottom
         this.y = this.height/2;
     }
    }
 }

  function updateCanvas() {
   myCanvas.clear();
   myPlayer.moveAngle = 0;
   myPlayer.newPos();
   myPlayer.update();
 }

 //Buttons
 function move() { //Move in the direction icon is facing.
    if (f == "W") { //x-axis, left
        myPlayer.speed = -1;
        if (x <= 0) { x = Number(x); }
        else { x = Number(x)-1; }
    } else if (f == "E") {  //x-axis, right
        myPlayer.speed = -1;
        if (x >= 300) { x = Number(x); }
        else { x = Number(x)+1; }
    } else if (f == "N") {  //y-axis, top
        myPlayer.speed = 1;
        if (y >= 300) { y = Number(y); }
        else { y = Number(y)+1; }
    } else if (f == "S") {  //y-axis, bottom
        myPlayer.speed = 1;
        if (y <= 0) { y = Number(y); }
        else { y = Number(y)-1;}
    }
}

 function clearMove() {
   myPlayer.speed = 0;
 }

 function rotateLeft() { //Left side of icon.
     if (f == "S") {
       f = "W";
     } else if (f == "W") {
       f = "N";
     }  else if (f == "N") {
       f = "E";
     } else if (f == "E") {
       f = "S";
     }
     myPlayer.moveAngle = 1;
     myPlayer.newPos();
     myPlayer.update();
}

 function rotateRight() { //Right side of icon.
    if (f == "S") {
      f = "E";
    } else if (f == "E") {
      f = "N";
    } else if (f == "N") {
      f = "W";
    } else if (f == "W") {
      f = "S";
    }
   myPlayer.moveAngle = -1;
   myPlayer.newPos();
   myPlayer.update();
}

 function report(){
   document.getElementById("location").innerHTML = "X: "+x+"   Y: "+y+"   F: "+f;
 }
</script>
