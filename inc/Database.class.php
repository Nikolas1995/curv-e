<?php
class Database
{
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "projectmanager";
	
	private $dbh;
	
	function __construct()
	{
		$this->dbh = @mysql_connect($this->host, $this->username, $this->password);
		
		if ($this->dbh == FALSE) {
			echo "Es ist ein Fehler bei der Datenbankverbindung aufgetreten, <br /> bitte kontaktieren Sie den Administrator.";
			echo mysql_error();
			exit;
		}
		
		mysql_select_db($this->database);
	}
	
	public function getValues($mColumns, $mTable, $mCondition, $mLimit, $mOrder)
	{
		$sql = "SELECT " . $mColumns . " FROM " . $mTable;
		if (!$mCondition == "") {
			$sql .= " WHERE " . $mCondition;
		}
		if (!$mOrder == "") {
			$sql .= " ORDER BY " . $mOrder;
		}
		if (!$mLimit == "") {
			$sql .= " LIMIT " . $mLimit;
		}
		
		$sql .= ";";
		$res = mysql_query($sql)
							or die ("Es ist ein Fehler bei der Datenbankabfrage WHERE aufgetreten, <br /> bitte kontaktieren Sie den Administrator.");
		$results;
		$i = 0;
		
		while ($row = mysql_fetch_row($res)) {
			$results[$i] = $row;
			$i++;
		}
		return $results;
	}
	
	public function setValue($mColumn, $mTable, $mValue, $mCondition)
	{
		$sql = "UPDATE $mTable SET $mColumn = '$mValue' WHERE $mCondition";
		
		$res = mysql_query($sql)
							or die ("Es ist ein Fehler bei der Datenbankabfrage aufgetreten, <br /> bitte kontaktieren Sie den Administrator.");
	}
	
	public function setValues($mArray, $mTable, $mCondition)
	{
		$sql = "UPDATE $mTable SET ";
		$first = true;
		foreach($mArray as $mSet) 
		{
			if ($first == false) {
				$sql .= ", ";
			}
			$sql .= $mSet['c'] . " = '" . $mSet['v'] . "'";
			$first = false;
		}
		$sql .= "WHERE " . $mCondition;
		
		$res = mysql_query($sql)
							or die ("Es ist ein Fehler bei der Datenbankabfrage aufgetreten, <br /> bitte kontaktieren Sie den Administrator.");
	}
	
	public function addValues($mColumns, $mTable, $mValues)
	{
		$sql = "INSERT INTO $mTable ($mColumns) VALUES ($mValues)";
		
		$res = mysql_query($sql)
							or die ("Es ist ein Fehler bei der Datenbankabfrage aufgetreten, <br /> bitte kontaktieren Sie den Administrator.");
	}
	
	public function deleteValues($mTable, $mCondition)
	{
		
	}
	/**
	 * @deprecated
	public function getValues($mTable, $mWhat, $mWhere)
	{
		$sql = "SELECT " . $mWhat . " FROM " . $mTable . " WHERE " . $mWhere;
		//var_dump($sql); //!
		$res = mysql_query($sql)
							or die ("Es ist ein Fehler bei der Datenbankabfrage aufgetreten, <br /> bitte kontaktieren Sie den Administrator.");				
		$results; //Deklaration von Ergebnis-Array
		$i = 0; //Zaehlvariable
		while ($row = mysql_fetch_row($res)) {
			$results[$i] = $row; //$row (ausgelesene Werte) in $results schreiben
			$i++;
		}
		return $results; //Ergebnisse als Array ausgeben
	}

	public function setValues($mTable, $mWhat, $mValue, $mWhere)
	{
		$sql = "UPDATE $mTable SET $mWhat = '$mValue' WHERE $mWhere";
		//var_dump($sql); echo "<br />";//!
		
		$res = mysql_query($sql)
							or die ("Es ist ein Fehler bei der Datenbankabfrage aufgetreten, <br /> bitte kontaktieren Sie den Administrator.");
	}

	public function addValues($mTable, $mWhat, $mValues)
	{
		$sql = "INSERT INTO $mTable ($mWhat) VALUES ($mValues)";
		//echo $sql;
		$res = mysql_query($sql)
							or die ("Es ist ein Fehler bei der Datenbankabfrage aufgetreten, <br /> bitte kontaktieren Sie den Administrator.");
	}
	 */
}
?>