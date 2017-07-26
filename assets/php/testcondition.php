<?php
	// $_REQUEST['from']['user'] & $_REQUEST['from']['service_head'] & $_REQUEST['from']['service_details'] & $_REQUEST['from']['service_action']
	$text = $_REQUEST['from']['user'].$_REQUEST['from']['service_head'].$_REQUEST['from']['service_details'].$_REQUEST['from']['service_action'];
	
	echo ($text) ;
	
?>