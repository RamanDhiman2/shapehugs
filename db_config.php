<?php
   $con = mysqli_connect("localhost", "root", "", "db_shapehugs");
   if(!$con){
      die("Database connection failed: " . mysqli_connect_error());  
   } 

?>