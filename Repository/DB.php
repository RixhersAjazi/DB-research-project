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
		$this->db = new PDO('mysql:dbname=iste330t23;host=localhost;', 'iste330t23', 'delightteacher');
	}

  // Prepares and executes statement to insert new data
	public function execute($sql, $params, $userClass = null)
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

	// Prepares and executes statement to retrieve data
	public function getAll($sql, $params = [])
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

  // Closes database
	public function close()
	{
		$this->db = null;
	}
}