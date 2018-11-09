<?php

class DB
{
	/**
	 * @var PDO $db
	 */
	private $db = null;

	public function open()
	{
		$this->db = new PDO('mysql:dbname=research_db;host=8.41.72.142;', 'root', 'rix');
	}

	public function insert($sql, $params, $userClass = null)
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
	}

	public function get($sql, $params, $userClass = null)
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		if ($userClass === null) {
			$userClass = 'stdClass';
		}

		return $stmt->fetchObject($userClass);
	}

	public function close()
	{
		$this->db = null;
	}
}