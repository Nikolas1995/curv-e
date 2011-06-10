<?php
require_once 'Database.class.php';
class Account
{
	var $ac_id;
	var $ac_firstname;
	var $ac_lastname;
	var $ac_title;
	var $ac_email;
	var $ac_password;
	var $ac_salt;
	var $ac_registered;
	var $ac_telephone;
	var $ac_locationCountry;
	var $ac_locationTown;
	var $ac_locationAdress;
	var $ac_firm;
	var $ac_firmTitle;
	
	private $db;
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function getByID($mID) {
		$this->ac_id = $mID;
		$this->getData();
	}
	
	public function getIDByEmail($mEmail) {
		$res = $this->db->getValues("ac_id", "accounts", "ac_email = '$mEmail'", "", "");
		$this->ac_id = $res[0][0];
	}
	
	public function getByEmail($mEmail) {
		$res = $this->db->getValues("ac_id", "accounts", "ac_email = '$mEmail'", "", "");
		$this->ac_id = $res[0][0];
		$this->getData();
	}
	
	public function getData() {
		$res = $this->db->getValues("*", "accounts", "ac_id = '$this->ac_id'", "", "");
		$this->ac_firstname = $res[0][1];
		$this->ac_lastname = $res[0][2];
		$this->ac_title = $res[0][3];
		$this->ac_email = $res[0][4];
		$this->ac_password = $res[0][5];
		$this->ac_salt = $res[0][6];
		$this->ac_registered = $res[0][7];
		$this->ac_telephone = $res[0][8];
		$this->ac_locationCountry = $res[0][9];
		$this->ac_locationTown = $res[0][10];
		$this->ac_locationAdress = $res[0][11];
		$this->ac_firm = $res[0][12];
		$this->ac_firmTitle = $res[0][13];
	}
	
	public function saveData() {
		$this->db->setValue("ac_firstname", "accounts", "$this->ac_firstname", "ac_id = $this->ac_id");
		$this->db->setValue("ac_lastname", "accounts", "$this->ac_lastname", "ac_id = $this->ac_id");
		$this->db->setValue("ac_title", "accounts", "$this->ac_titlename", "ac_id = $this->ac_id");
		$this->db->setValue("ac_telephone", "accounts", "$this->ac_telephone", "ac_id = $this->ac_id");
		$this->db->setValue("ac_locationCountry", "accounts", "$this->ac_locationCountry", "ac_id = $this->ac_id");
		$this->db->setValue("ac_locationTown", "accounts", "$this->ac_locationTown", "ac_id = $this->ac_id");
		$this->db->setValue("ac_locationAdress", "accounts", "$this->ac_locationAdress", "ac_id = $this->ac_id");
		$this->db->setValue("ac_firm", "accounts", "$this->ac_firm", "ac_id = $this->ac_id");		
	}
	
	public function createAccount() {
		$this->db->addValues("ac_email, ac_password, ac_salt", "accounts", "'$this->ac_email', '$this->ac_password', '$this->ac_salt'");
		$this->getIDByEmail($this->ac_email);
		$this->ac_registered = time();
		$this->saveData();
	}
	
	public function setPassword($mPassword) {
		$this->ac_salt = md5(rand(12443, 24533426));
		$this->ac_password = md5($mPassword . md5($this->ac_salt));
	}
	
	public function checkLogin($mEmail, $mPassword) {
		$this->getByEmail($mEmail);	
		$password = md5($mPassword . md5($this->ac_salt));
		return $password == $this->ac_password;
	}
}
?>