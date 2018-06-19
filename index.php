<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Zen Rooms Test</title>
  <style>canvas {border: 1px solid #c3c3c3; background-color: #111111;}</style>
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php include 'indexsubmitted.php';?>
</head>

<body onload="createCanvas()">
<div id="location" style="text-align:center;width:300px;font-size:12px;color:blue"></div>
<div style="text-align:left;width:380px">
<br><image id="icon" src="icon.png" width="32" height="32">
<br><br>
Enter N, S, W, or E for F. Canvas size is 300px * 300px.
<form action="index.php" method="post">
  X: <input type="text" name="x" maxlength="3" size="6">
  Y: <input type="text" name="y" maxlength="3" size="6">
  F: <input type="text" name="f" maxlength="1" size="6">
<input type="submit" name="submit">
<br>
<span class="error" style="color:red"><?php echo $errMsg; ?></span>
</div>
</form>

<br><br>
<!-- Buttons -->
<div style="text-align:center;width:300px">
  <input type="button" value="Move" onmousedown="move()" onmouseup="clearMove()">
  <input type="button" value="Rotate Left" onclick="rotateLeft()">
  <input type="button" value="Rotate Right" onclick="rotateRight()">
  <input type="button" value="Report" onclick="report()">
</div>
</body>
</html>
