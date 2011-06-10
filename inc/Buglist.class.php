<?php
require_once 'Database.class.php';
require_once 'Bug.class.php';
require_once 'Project.class.php';
class Buglist
{
	var $bugl_id;
	var $bugl_name;
	var $pr_id;
	
	var $db;
	
	function __construct()
	{
		$this->db = new Database();
	}
	
	public function getByID($mID) {
		$this->bugl_id = $mID;
		$this->getData();
	}
	
	public function getData() {
		$res = $this->db->getValues("*", "buglists", "bugl_id = '$this->bugl_id'", "", "");
		$this->bugl_name = $res[0][2];
		$this->pr_id = $res[0][1];
	}
	
	public function saveData() {
		$this->db->setValue("bugl_name", "buglists", "$this->bugl_name", "bugl_id = $this->bugl_id");
	}
	
	public function createBuglist() {
		$this->db->addValues("bugl_id, bugl_name, pr_id", "buglists", $this->bugl_id . ", '" . $this->bugl_name . "', " . $this->pr_id);
	}
	
	public function getBugs($from, $many) {
		$res = $this->db->getValues("bug_id", "bugs", "bugl_id = $this->bugl_id ", "", "");
		
		$bugs = array();
		for($i = 0; $i<count($res); $i++) {
			$bug = new Bug();
			$bug->getByID($res[$i][0]);
			$bugs[$i] = $bug;
		}
		return $bugs;
	}
	
	public function getNumFinished() {
		$res = $this->db->getValues("count(bug_id)", "bugs", "(bugl_id = $this->bugl_id) AND (bug_status = 3)", "", "");
		
		return $res[0][0];
	}
	
	public function getNumPending() {
		$res = $this->db->getValues("count(bug_id)", "bugs", "(bugl_id = $this->bugl_id) AND (bug_status = 0)", "", "");
		
		return $res[0][0];
	}
}
?>