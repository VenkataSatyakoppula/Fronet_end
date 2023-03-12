<?php
include 'config.php';
  if(isset($_POST["id"]) ){
  $_SESSION["user_id"] = $_POST['id'];
  $_SESSION["userData"] = $_POST['userData'];
  $_SESSION['refresh_token']  = $_POST['refresh_token'];
  echo(json_encode(array("success"=>true)));
  die;
  }
  if(isset($_POST["remeber"])){
    $_SESSION["remeber"] = $_POST["remeber"];
  }
  if(isset($_POST["refresh_token"])){
    $_SESSION['refresh_token']  = $_POST['refresh_token'];
    echo("refreshed");
  }
  if (isset($_POST["userData"])) {
    $_SESSION["userData"] = $_POST['userData'];
    echo("success");
  }
  if(isset($_GET["userdata"])){
    $out = array("userData" => $_SESSION["userData"]);
    echo json_encode($out);
  }
  if(isset($_GET["gettoken"])){
    $res = array("refresh" => $_SESSION['refresh_token']);
    echo json_encode($res);
  }
?>