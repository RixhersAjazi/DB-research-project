<?php
/**
 * Class for connecting and interacting with MySQL database
 */
class DB
{
	/**
	 * @var PDO $db
	 */
	private $db = null;

  // Opens connection
	public function open()
	{
		$this->db = new PDO('mysql:dbname=research_db;host=8.41.72.142;', 'root', 'rix');
	}

  // Prepares and executes statement to insert new data
	public function insert($sql, $params, $userClass = null)
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
	}

  // Prepares and executes statement to retrieve data
	public function get($sql, $params = [], $userClass = null)
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		if ($userClass === null) {
			$userClass = 'stdClass';
		}

		return $stmt->fetchObject($userClass);
	}

  // Closes database
	public function close()
	{
		$this->db = null;
	}
}