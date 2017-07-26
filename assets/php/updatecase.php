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
  $return['message'] = "Mysqli Connected";
} catch (Exception $e) {
  $return['status'] = "error";
  $return['message'] = "Unable to connect to Mysql";
  $return['data']['error'] = $e->getMessage();
  die(json_encode($return));
}


$get_max = $dbh -> prepare("SELECT MAX(`action_time`) FROM `service_action` WHERE `service_id` = '".$_REQUEST['case_id']."'");
$get_max -> execute();
$max_number = $get_max -> fetch();
$run_number = $max_number['MAX(`action_time`)']+1;

$_REQUEST['files'] 		= "";
$_REQUEST['picture'] 	= "";
$_CurrentStatus = $_REQUEST['old_status'];
$_CurrentDuty	= "";

$get_duty = $dbh -> prepare("SELECT * FROM `service_head` WHERE `service_id` = '".$_REQUEST['case_id']."'");
$get_duty -> execute();
$case_duty = $get_duty -> fetch();




if ($_REQUEST['old_status'] != $_REQUEST['status']) {
	# code...
	$_CurrentStatus = $_REQUEST['status'];

	if ($_REQUEST['assign'] == "" ) {
		# code...
		$_CurrentDuty	= $case_duty['duty'];
	} else {
		# code...
		$_CurrentDuty = $_REQUEST['assign'];
	}

} else {

	if ($_REQUEST['assign'] == "" ) {
		# code...
		$_CurrentDuty = $case_duty['duty'];
	} else {
		# code...
		$_CurrentDuty = $_REQUEST['assign'];
	}

}

// echo 	"Status : ".$_REQUEST['old_status']." >> ".$_REQUEST['status']." = ".$_CurrentStatus."\n"."Duty   : ".$_SESSION['user']." >> ".$_REQUEST['assign']." = ".$_CurrentDuty;

$insert_case = "INSERT INTO `service_action`(`service_id`, `action_time`, `action_by`, `action_desc`, `action_to`, `file`, `picture`, `status` ) VALUES('".$_REQUEST['case_id']."', '".$run_number."', '".$_SESSION['user']."', '".$_REQUEST['desc']."', '".$_CurrentDuty."', '".$_REQUEST['files']."', '".$_REQUEST['picture']."', '".$_CurrentStatus."')";

$update_status = "UPDATE `service_head` SET `status` = '".$_CurrentStatus."', `duty` = '".$_CurrentDuty."' WHERE `service_id` = '".$_REQUEST['case_id']."'";

try {          

      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);      
      $dbh->beginTransaction();
      $stmt1 = $dbh->prepare($insert_case);
      $stmt1 -> execute();
      $stmt2 = $dbh->prepare($update_status);
      $stmt2 -> execute();        
      $dbh->commit();
      $return['message'] = "Commit update status at : ".date("d-m-y H:i:s").json_encode($dbh);

    } catch (Exception $e) {
      $dbh->rollBack();
      $return['status']  = "error";
      $return['message'] = "Rollback Transaction";
      $return['data']['error'] = $e->getMessage().json_encode($dbh);
      $dbh = null;
    }


echo json_encode($return);

?>