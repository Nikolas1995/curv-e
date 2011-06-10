<?php
require_once 'Database.class.php';
require_once 'Auth.class.php';
require_once 'Buglist.class.php';
class Project
{
	var $pr_id;
	var $pr_name;
	var $pr_description;
	var $pr_created;
	
	private $db;
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function getByID($mID) {
		$this->pr_id = $mID;
		$this->getData();
	}
	
	public function getData() {
		$res = $this->db->getValues("*", "projects", "pr_id = '$this->pr_id'", "", "");
		$this->pr_name = $res[0][1];
		$this->pr_description = $res[0][2];
		$this->pr_created = $res[0][3];
	}
	
	public function saveData() {
		$this->db->setValue("pr_name", "projects", "$this->pr_name", "pr_id = $this->pr_id");
		$this->db->setValue("pr_description", "projects", "$this->pr_description", "pr_id = $this->pr_id");
	}
	
	public function createProject() {
		$this->db->addValues("pr_name, pr_description", "projects", "'$this->pr_name', '$this->pr_description'");
		$res = $this->db->getValues("pr_id", "projects", "", "1", "pr_id DESC");
		$this->pr_id = $res[0][0];
	}
	
	public function addUser($ac_id, $group) {
		$this->db->addValues("pr_id, ac_id, group", "account2project", "$this->pr_id, $ac_id, $group");
	}
	
	public function getUsers() {
	}
	
	public function getBuglists() {
		$res = $this->db->getValues("bugl_id", "buglists", "pr_id = $this->pr_id", "", "");
		$buglists = array();
		for($i = 0; $i<count($res); $i++) {
			$buglist = new Buglist();
			$buglist->getByID($res[$i][0]);
			$buglists[$i] = $buglist;
		}
		return $buglists;
	}
	
	public function getFavoriteBuglist() {
		$res = $this->db->getValues("bugl_id", "buglists", "(pr_id = $this->pr_id ) AND (bugl_favorite = 1)", "", "");
		$buglist = new Buglist();
		$buglist->getByID($res[0][0]);
		
		return $buglist;
	}
	
	public function getNumFinishedBugs() {
		$num=0;
		$buglists = $this->getBuglists();
		foreach($buglists as $buglist) {
			$num += $buglist->getNumFinished();
		}
		return $num;
	}
	
	public function getNumPendingBugs() {
		$num=0;
		$buglists = $this->getBuglists();
		foreach($buglists as $buglist) {
			$num += $buglist->getNumPending();
		}
		return $num;
	}
}
?>