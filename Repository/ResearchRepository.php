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
		$db->execute(
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
		$sql = "SELECT 
					research.research_id as researchId,
					users.name as professor, 
					research.name as name, 
					research.description, 
					categories.name as categoryName, 
					research.results 
				FROM research
				INNER JOIN users on users.id = research.professor_id
				INNER JOIN categories ON categories.id = research.category
				";
		$db = new DB();
		$db->open();
		$results = $db->getAll($sql);
		$db->close();
		return $results;
	}

	public function delete($researchId)
	{
		$sql = "DELETE FROM research WHERE research_id = :id";
		$db = new DB();
		$db->open();
		$db->execute($sql, [':id' => $researchId]);
		$db->close();
		return true;
	}
}
