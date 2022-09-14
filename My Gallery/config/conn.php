<?php

$conn= new mysqli("localhost","root","","mygallery");
if($conn->connect_error)
  print($conn->error);


?>