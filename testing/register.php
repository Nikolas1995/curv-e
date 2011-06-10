<?php
	require_once '../inc/Account.class.php'; 
	if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
		echo "Registrierung erfolgreich.";
		$account = new Account();
		$account->ac_email = $_POST['email'];
		$account->setPassword($_POST['password']);
		$account->ac_firstname = $_POST['firstname'];
		$account->ac_lastname = $_POST['lastname'];
		$account->ac_registered = time();
		$account->createAccount();
	}
?>
<form action="register.php" method="post">
	<p>E-Mail:<br /><input name="email" type="text" size=100"> </p>
  	<p>Kennwort:<br><input name="password" type="password" size="100"></p>
  	<p>Vorname:<br><input name="firstname" type="text"></p>
  	<p>Nachname:<br /><input name="lastname" type="text"></p>
  	<input name="submit" type="submit">
</form>