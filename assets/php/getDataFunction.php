<?php

session_start();

if (!isset($_SESSION['user'])) {
header('Location: login.html'); 
}

require ("../../config/php_conf.cfg");

try { 

  $dbh = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
  $dbh->exec("set names utf8");
  // $dbh->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
  // die(json_encode(array('outcome' => true)));
  $return['status']  = "Success";
  $return['message'] = "Mysqli Connected";
} catch (Exception $e) {
  $return['status'] = "error";
  $return['message'] = "Unable to connect to Mysql";
  $return['data']['error'] = $e->getMessage();
  die(json_encode($return));
}

try {

  $results = $dbh -> prepare("SELECT `fname`, `lname` FROM `user` WHERE `user_id` = '".$_REQUEST['user_id']."'");
    $results -> execute();
    $result = $results -> fetchAll();
    $return['message'] = "Successfully : ";
    $return['query'] = "";
    $return['data'] = $result;
  
} catch (Exception $e) {

  $return['status']  = "error";
  $return['message'] = "Cannot get data : ".$query;
  $return['data']['error'] = $e->getMessage().json_encode($dbh);
  
} finally {
    $dbh = null;
}

echo json_encode($return);