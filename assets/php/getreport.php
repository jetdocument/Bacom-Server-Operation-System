<?php
	$select = "";
	$from 	= "";
	$where 	= "";

	$text = $_REQUEST['from']['user'].$_REQUEST['from']['service_head'].$_REQUEST['from']['service_details'].$_REQUEST['from']['service_action'];
	
	if ( 	$text == "ABCD" ) {
		# code...ABCD
		$from = "`user` JOIN `service_head` JOIN `service_details` JOIN `service_action` ON ( 	`user`.`user_id` = `service_head`.`duty` AND `service_head`.`service_id` = `service_details`.`service_id` AND `service_head`.`service_id` = `service_action`.`service_id` ) ";
	} else if ( 	$text == "ABC" ) {
		# code...ABC
		$from = "`user` JOIN `service_head` JOIN `service_details` JOIN `service_action` ON (`user`.`user_id` = `service_head`.`duty` AND `service_head`.`service_id` = `service_details`.`service_id` ) ";
	} else if ( 	$text == "ABD" ) {
		# code...ABD
		$from = "`user` JOIN `service_head` JOIN `service_details` JOIN `service_action` ON ( 	`user`.`user_id` = `service_head`.`duty` AND `service_head`.`service_id` = `service_action`.`service_id` ) ";
	}  else if ( 	$text == "ACD" ) {
		# code...ACD
		$from = "`user` JOIN `service_head` JOIN `service_details` JOIN `service_action` ON (`user`.`user_id` = `service_head`.`duty` AND `service_head`.`service_id` = `service_details`.`service_id` AND `service_head`.`service_id` = `service_action`.`service_id` ) ";
	}  else if ( 	$text == "BCD" ) {
		# code...BCD
		$from = "`service_head` JOIN `service_details` JOIN `service_action` ON ( `service_head`.`service_id` = `service_details`.`service_id` AND `service_head`.`service_id` = `service_action`.`service_id` ) ";
	}  else if ( 	$text == "AB" ) {
		# code...AB
		$from = "`user` JOIN `service_head` ON (`user`.`user_id` = `service_head`.`duty` ) ";
	}  else if ( 	$text == "AC" ) {
		# code...AC
		$from = "`user` JOIN `service_head` JOIN `service_details` ON (`user`.`user_id` = `service_head`.`duty` AND `service_head`.`service_id` = `service_details`.`service_id` ) ";
	}  else if ( 	$text == "AD" ) {
		# code...AD
		$from = "`user` JOIN `service_action` ON (`user`.`user_id` = `service_action`.`action_by` ) ";
	}  else if ( 	$text == "BC" ) {
		# code...BC
		$from = "`service_details` JOIN `service_action` ON ( `service_details`.`service_id` = `service_action`.`service_id` ) ";
	}  else if ( 	$text == "BD" ) {
		# code...BD
		$from = "`service_head` JOIN `service_action` ON (`service_head`.`service_id` = `service_action`.`service_id` ) ";
	}  else if ( 	$text == "CD" ) {
		# code...CD
		$from = "`service_details` JOIN `service_action` ON (`service_details`.`service_id` = `service_action`.`service_id` ) ";
	} else if ( 	$text == "A" ) {
		# code...A
		$from = "`user`";
	} else if ( 	$text == "B"  ) {
		# code...B
		$from = "`service_head`";
	} else if ( 	$text == "C" ) {
		# code...C
		$from = "`service_details` ";
	} else if ( 	$text == "D" ) {
		# code...D
		$from = "`service_action` ";
	} 
	

	if (isset($_REQUEST['query']['user'])) {
			# code...
		// if ($from == "") {
		// 	# code...
		// 	$from = "`user`";
		// }
		
		for ($i=0; $i < sizeof($_REQUEST['query']['user']); $i++) { 
				# code...
			if ($select == "") {
				# code...
				$select = "`user`.`".$_REQUEST['query']['user'][$i]."`";
			} else {
				# code...
				$select = $select.",`user`.`".$_REQUEST['query']['user'][$i]."`";
			}
		}
	}

	if (isset($_REQUEST['query']['service_head'])) {
			# code...
		// if ($from == "") {
		// 	# code...
		// 	$from = "`service_head`";
		// }
		for ($i=0; $i < sizeof($_REQUEST['query']['service_head']); $i++) { 
			# code...
			if ($select == "") {
				# code...
				$select = "`service_head`.`".$_REQUEST['query']['service_head'][$i]."`";
			} else {
				# code...
				$select = $select.",`service_head`.`".$_REQUEST['query']['service_head'][$i]."`";
			}
		}
	}

	if (isset($_REQUEST['query']['service_details'])) {
			# code...
		// if ($from == "") {
		// 	# code...
		// 	$from = "`service_details`";
		// }
		for ($i=0; $i < sizeof($_REQUEST['query']['service_details']); $i++) { 
			# code...
			if ($select == "") {
				# code...
				$select = "`service_details`.`".$_REQUEST['query']['service_details'][$i]."`";
			} else {
				# code...
				$select = $select.",`service_details`.`".$_REQUEST['query']['service_details'][$i]."`";
			}
		}
	}

	if (isset($_REQUEST['query']['service_action'])) {
			# code...
		// if ($from == "") {
		// 	# code...
		// 	$from = "`service_action`";
		// }
		for ($i=0; $i < sizeof($_REQUEST['query']['service_action']); $i++) { 
			# code...
			if ($select == "") {
			# code...
				$select = "`service_action`.`".$_REQUEST['query']['service_action'][$i]."`";
			} else {
				# code...
				$select = $select.",`service_action`.`".$_REQUEST['query']['service_action'][$i]."`";
			}
		}
	}
	

	if ($_REQUEST['where']['first_variable'] != "") {
		# code...
		if ($_REQUEST['where']['operator'] == "BETWEEN") {
			# code...
			if ($where == "") {
			# code...
				$where = "`".$_REQUEST['where']['con_table']."`.`".$_REQUEST['where']['con_column']."` BETWEEN '".$_REQUEST['where']['first_variable']."' AND '".$_REQUEST['where']['second_variable']."'";
			} else {
				# code...
				$where = $where." AND `".$_REQUEST['where']['con_table']."`.`".$_REQUEST['where']['con_column']."` BETWEEN '".$_REQUEST['where']['first_variable']."' AND '".$_REQUEST['where']['second_variable']."'";
			}
		} else if ($_REQUEST['where']['operator'] == "LIKE"){
			# code...
			if ($where == "") {
				# code...
				$where = "`".$_REQUEST['where']['con_table']."`.`".$_REQUEST['where']['con_column']."` ".$_REQUEST['where']['operator']." '%".$_REQUEST['where']['first_variable']."%'";
			} else {
				# code...
				$where = $where." AND `".$_REQUEST['where']['con_table']."`.`".$_REQUEST['where']['con_column']."` ".$_REQUEST['where']['operator']." '%".$_REQUEST['where']['first_variable']."%'";
			}
		} else {
			if ($where == "") {
				# code...
				$where = "`".$_REQUEST['where']['con_table']."`.`".$_REQUEST['where']['con_column']."` ".$_REQUEST['where']['operator']." '".$_REQUEST['where']['first_variable']."'";
			} else {
				# code...
				$where = $where." AND `".$_REQUEST['where']['con_table']."`.`".$_REQUEST['where']['con_column']."` ".$_REQUEST['where']['operator']." '".$_REQUEST['where']['first_variable']."'";
			}
		}		
	}

	if ($_REQUEST['where']['start'] != "" && $_REQUEST['where']['end'] != "") {
		# code...		
		if ($where == "") {
			# code...
			$where = "`".$_REQUEST['where']['date_table']."`.`".$_REQUEST['where']['date_column']."` BETWEEN '".$_REQUEST['where']['start']."' AND '".$_REQUEST['where']['end']."'";
		} else {
			# code...
			$where = $where." AND `".$_REQUEST['where']['date_table']."`.`".$_REQUEST['where']['date_column']."` BETWEEN '".$_REQUEST['where']['start']."' AND '".$_REQUEST['where']['end']."'";
		}
	}

	if ($where == "") {
		# code...
		$query = "SELECT DISTINCT ".$select." FROM ".$from." WHERE 1";
	} else {
		# code...
		$query = "SELECT DISTINCT ".$select." FROM ".$from." WHERE ".$where;
	}

// echo $query;

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

	$results = $dbh -> prepare($query);
    $results -> execute();
    $result = $results -> fetchAll();
    $return['message'] = "Successfully : ".$query;
    $return['query'] = $query;
    $return['data'] = $result;
	
} catch (Exception $e) {

	$return['status']  = "error";
	$return['message'] = "Cannot get data : ".$query;
	$return['data']['error'] = $e->getMessage().json_encode($dbh);
	
} finally {
  	$dbh = null;
}

echo json_encode($return);

?>