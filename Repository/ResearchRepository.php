<?php

require_once __DIR__ . '/DB.php';

/**
 * Class for mapping research objects into the database.
 */
class ResearchRepository
{
	/**
	 * @param Research $research
	 */

  /**
   * Inserts into the database based on a research object
   */
	public function create($research)
	{
		$sql = "INSERT INTO research (`professor_id`, `name`, `description`, `category`, `results`) VALUES (:prof, :name, :desc, :cat, :res)";
		$db = new DB();
		$db->open();
		$db->insert(
			$sql,
			[
				':prof' => $research->getProfessorId(),
				':name' => $research->getName(),
				':desc' => $research->getDescription(),
				':cat' => $research->getCategory(),
				':res' => $research->getResults()
			]
		);
		$db->close();
		return true;
  }
  
  /**
   * Gets all data of one research based on its ID
   */
	public function get($researchId)
	{
		$sql = "SELECT * FROM research WHERE id = :id";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $researchId]);
		$db->close();
		return $results;
	}

  /**
   * Gets data for all research in database
   */
	public function getAll()
	{
		$sql = "SELECT * FROM research";
		$db = new DB();
		$db->open();
		$results = $db->getAll($sql);
		$db->close();
		return $results;
	}
}
