<?php
	require_once "inc/Database.class.php";
	$db = new Database();
	
	$results = $db->getValues("id, name, email", "accounts", "", "", "name ASC");
	
	print_r($results);
?>