<?php

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
		$this->researchId = $data->user;
		$this->professorId = $data->email;
		$this->name = $data->name ?: '';
		$this->description = $data->description ?: '';
		$this->category = $data->category ?: 3;
		$this->results = $data->results ?: "";
	}

	public function isValid()
	{
//		if (!isset($this->user) || !isset($this->password) || !isset($this->role) || !isset($this->email)) {
//			return false;
//		}
//
//		if (!is_string($this->user) || strlen($this->password) > 20) {
//			return false;
//		}
//
//		if (!is_string($this->password) || strlen($this->password) > 20) {
//			return false;
//		}
//
//		if (!is_string($this->role) || !in_array($this->role, ['prof', 'student'])) {
//			return false;
//		}
//
//		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//			return false;
//		}

		return true;
	}

	/**
	 * @return mixed
	 */
	public function getResearchId()
	{
		return $this->researchId;
	}

	/**
	 * @return mixed
	 */
	public function getProfessorId()
	{
		return $this->professorId;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @return int
	 */
	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * @return string
	 */
	public function getResults()
	{
		return $this->results;
	}

	public function getArray()
	{
		return
			[
				'researchId' => $this->researchId,
				'profesorId' => $this->professorId,
				'name' => $this->name,
				'description' => $this->description,
				'category' => $this->category,
				'results' => $this->results
			];
	}
}
