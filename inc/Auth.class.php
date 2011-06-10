<?php
require_once 'Account.class.php';
require_once 'Project.class.php';

class Auth
{
	var $loggedIn = false;
	var $selProject;
	var $account;
	
	function __construct() {
		$this->account = new Account();
		if (isset($_COOKIE['projemail']) && isset($_COOKIE['projpassword'])) {
			$tryEmail = $_COOKIE['projemail'];
			$tryPassword = $_COOKIE['projpassword'];

			$this->logIn($tryEmail, $tryPassword);
			
			if (isset($_GET['pid'])) {
				$this->selProject = new Project();
				$this->selProject->getById($_GET['pid']);
			} else if (isset($_COOKIE['projproject'])) {
				$this->selProject = new Project();
				$this->selProject->getById($_COOKIE['projproject']);
			} else {
				$this->selProject = new Project();
			}
		}
	}
		
	public function logIn($mEmail, $mPassword) {
		if ($this->account->checkLogin($mEmail, $mPassword) && $mEmail != "") {
			$this->loggedIn = true;
			setcookie("projemail", $mEmail, 0);
			setcookie("projpassword", $mPassword, 0);
		}
	}
	
	public function logOut() {
		$this->loggedIn = false;
		setcookie("projemail", "", time()-60*60*24);
		setcookie("projpassword", "", time()-60*60*24);
	}
	
	public function setStandardProject($mProject) {
		setcookie("projproject", $mProject, time()+60*60*24);
	}
}
?>