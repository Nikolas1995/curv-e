<?php 
require_once "./inc/Auth.class.php";
require_once "./inc/Project.class.php";
error_reporting(E_ALL);
$auth = new Auth();
$loggedIn = $auth->loggedIn;
if (isset($_GET['loggedIn'])) {
	//$loggedIn = false; //DEBUG!
} else {
	//$loggedIn = true;
}
//$account = $auth->account;
$account = new Account();
$account->getByID(1);
$account->getData();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/reset.css">
<link rel="stylesheet" type="text/css" href="style/style.css">

<title>curv-e - Das Projektmanagementsystem</title>
</head>
<body>
<?php 
if ($loggedIn == true) {
//EINGELOGGT HTML Start!
?>
<div id="head_wrap">
	<div id="header">
	<div id="menu-left">
		<div id="logo">
		<a href="index.php"></a>
		</div>
		<div id="nav">
			<ul>
				<li>
				<a href="index.php">Dashboard</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="menu-right">
		<div id="menu">
			<div class="picture-menu">
			<a href="tasks.php"><img src="./img/tasks.png">
			<h3>Aufgaben</h3></a>
			</div>
			<a href="calendar.php"><div class="picture-menu">
			<img src="./img/cal.png">
			<h3>Kalender</h3></a>
			</div>
			<a href="adressbook.php"><div class="picture-menu">
			<img src="./img/adress.png">
			<h3>Adressbuch</h3></a>
			</div>
		</div>
		<div id="you">
			<div class="pic">
				
			</div>
			<div class="slogan">
				<?php 
					echo substr($account->ac_firstname, 0, 1) . ". $account->ac_lastname";
				?>
			</div>
		</div>
	</div>
	</div>
</div>
<?php 
//EINGELOGGT HTML Ende!
} else {
//NICHT EINGELOGGT HTML Start!
?>
<div id="head_wrap">
	<div id="header">
	<div id="menu-left">
		<div id="logo">
		<a href="index.php"></a>
		</div>
		<div id="nav">
			<ul>
				<li>
				<a href="index.php">Dashboard</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="menu-right">
		<div id="menu">
			
		</div>
		<div id="you">
			<div class="pic">
				
			</div>
			<div class="slogan">
				Nicht eingeloggt
			</div>
		</div>
	</div>
	</div>
</div>
<?php 
//NICHT EINGELOGGT HTML Ende!
}
?>