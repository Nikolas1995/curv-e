<?php
	require_once 'inc/Database.class.php';
	require_once 'inc/Account.class.php';
	
	$db = new Database();
	
	$members = array();
	$membersID = $db->getValues("ac_id", "accounts", "", "", "ac_lastname DESC");
	
	for ($i = 0; $i<count($membersID); $i++) {
		$account = new Account();
		$account->getByID($membersID[$i][0]);
		$members[$i] = $account;
	}
	
	echo "<table>";
	
	for ($i = 0; $i<count($members); $i++) {
		echo "<tr>";
		echo "<td>" . $members[$i]->ac_firstname . " " . $members[$i]->ac_lastname . "</td>";
		echo "</tr>";
	}
?>