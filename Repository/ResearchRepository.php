<?php

class ResearchRepository
{
	/**
	 * @param Research $research
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

	public function get($researchId)
	{
		$sql = "SELECT * FROM research WHERE id = :id";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $researchId]);
		$db->close();
		return $results;
	}

	public function getAll()
	{
		$sql = "SELECT * FROM research";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [], Research::class);
		$db->close();
		return $results;
	}
}
