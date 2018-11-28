<?php

require_once __DIR__ . '/../Repository/ResearchRepository.php';
require_once __DIR__ . '/../Exceptions/InvalidDataException.php';

/**
 * Class for users that is called by the API to call the repo methods to
 * interact with the database
 */

class ResearchService
{
  /**
   * For create
   */
	public static function create($postData)
	{
		$research = new Research($postData);
		if (!$research->isValid()) {
			throw new InvalidDataException();
		}

		$researchRepo = new ResearchRepository();
		if ($researchRepo->create($research) !== false) {
			return $research->getArray();
		} else {
			return null;
		}
	}
  /**
   * For get
   */
	public static function get($researchId)
	{
		$researchData = (new ResearchRepository())->get($researchId);
		if (!is_null($researchData)) {
			return (new User($researchData))->getArray();
		} else {
			return null;
		}
	}

  /**
   * For get all
   */
	public static function getAll()
	{
		return (new ResearchRepository())->getAll();
	}
}
