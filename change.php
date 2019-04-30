<?php

  $file_path = "start.json";
  $date = $_POST['date'];

  $file = fopen($file_path, "r");
  $read = fread($file, filesize($file_path));
  fclose($file);

  $output = "[{\"title\": \"Carmelina's feed\",\"start\": \"$date\"}]";

  $filenew = fopen($file_path, "w+");
  fwrite($filenew, $output);
  fclose($filenew);

?>
