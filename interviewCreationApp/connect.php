<?php

$con=mysqli_connect('localhost','root','','interview') or die('Cannot connect to server');
mysqli_select_db($con,'interview') or die ('Cannot found database');

?>