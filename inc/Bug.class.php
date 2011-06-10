<?php
require_once 'Database.class.php';
require_once 'Account.class.php';
require_once 'Buglist.class.php';
require_once 'Project.class.php';
class Bug
{
	var $bug_id;
	var $bug_name;
	var $bug_description;
	var $bug_type;
	var $bug_reproduce;
	var $bug_status;
	//status:
	//0 = pending
	//1 = seen
	//2 = in work
	//3 = finished
	var $bug_created;
	
	var $bugl_id;
	var $ac_idCreator;
	
	private $db;
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function getByID($mID) {
		$this->bug_id = $mID;
		$this->getData();
	}
	
	public function getData() {
		$res = $this->db->getValues("*", "bugs", "bug_id = '$this->bug_id'", "", "");
		$this->bug_name = $res[0][1];
		$this->bug_description = $res[0][2];
		$this->bug_type = $res[0][3];
		$this->bug_reproduce = $res[0][4];
		$this->bug_status = $res[0][5];
		$this->ac_idCreator = $res[0][6];
		$this->bug_created = $res[0][7];
		$this->bugl_id = $res[0][8];
	}
	
	public function getBuglist() {
		$buglist = new Buglist();
		$buglist->getByID($bugl_id);
		
		return $buglist;
	}
	
	public function getProject() {
		$buglist = $this->getBuglist();
		$project = new Project();
		$project->getByID($buglist->pr_id);
		
		return $project;
	}
	
	public function getProjectID() {
		$buglist = $this->getBuglist();
		
		return $buglist->pr_id;
	}
	
	public function saveData() {
		
	}
	
	public function createProject() {
		
	}
}
?>