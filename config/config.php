<?php
ob_start();
session_start();
function debug_to_console($data)
{
  $output = $data;
  if (is_array($output)) {
    $output = implode(',', $output);
  }

  echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

$timezone = date_default_timezone_set('America/New_York');

$con = mysqli_connect('localhost', 'root', '', 'social-site');

/** If error */
if (mysqli_connect_errno()) {
  echo 'failed to connect: ' . mysqli_connect_errno();
}
?>
