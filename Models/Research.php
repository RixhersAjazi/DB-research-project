<?php

require_once __DIR__ . '/../Models/Validator.php';
require_once __DIR__ . '/../Models/ArrayAble.php';

/**
 * Research class. Has a unique ID, and is tied to a unique 
 * professor user. Also has information such as name, description,
 * category of research, and results of research.
 */
class Research implements Validator, ArrayAble
{
	private $researchId;
	private $professorId;
	private $name;
	private $description;
	private $category;
	private $results;

	public function __construct($data)
	{
		if (!empty($data)) {
			if ($data instanceof stdClass) {
				$this->researchId = $data->research_id;
				$this->professorId = $data->professor_id;
				$this->name = $data->name;
				$this->description = $data->description;
				$this->category = $data->category;
				$this->results = $data->results;
			} else {
				$this->researchId = array_key_exists('researchId', $data) ? $data['researchId'] : 0;
				$this->professorId = $data['professorId'];
				$this->name = $data['name'];
				$this->description = $data['description'];
				$this->category = $data['category'];
				$this->results = $data['results'];
			}
		}
	}

  /**
   * Checks if the research properties align with the table constraints
   */
	public function isValid()
	{
		if (!isset($this->name) || !isset($this->description) || !isset($this->category) || !isset($this->professorId) || !isset($this->researchId)) {
			return false;
		}

		if (!is_string($this->name)) {
			return false;
		}

		if (!is_string($this->description)) {
			return false;
		}

		return true;
	}

	/**
	 * @return mixed
   * Returns research ID
	 */
	public function getResearchId()
	{
		return $this->researchId;
	}

	/**
	 * @return mixed
   * Returns ID of the professor tied to the project
	 */
	public function getProfessorId()
	{
		return $this->professorId;
	}

	/**
	 * @return string
   * Returns name of research project
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
   * Returns project description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @return int
   * Returns category
	 */
	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * @return string
   * Returns results of research
	 */
	public function getResults()
	{
		return $this->results;
	}

  /**
   * Returns properties as an array
   */
	public function getArray()
	{
		return
			[
				'researchId' => $this->researchId,
				'professorId' => $this->professorId,
				'name' => $this->name,
				'description' => $this->description,
				'category' => $this->category,
				'results' => $this->results
			];
	}
}
