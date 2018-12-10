<?php

require_once __DIR__ . '/../Repository/ResearchRepository.php';
require_once __DIR__ . '/../Models/Research.php';
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
//		if (!$research->isValid()) {
//			throw new InvalidDataException();
//		}

		$researchRepo = new ResearchRepository();
		if ($researchRepo->create($research) !== false) {
			$rtn = $research->getArray();
			unset($rtn['researchId']);
			return $rtn;
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
			return (new Research($researchData))->getArray();
		} else {
			return null;
		}
	}

  /**
   * For get all
   */
	public static function getAll()
	{
		$researchRecords = (new ResearchRepository())->getAll();

		$research = new stdClass();

		if (!is_null($researchRecords)) {
			/**
			 * @var User $record
			 */
			foreach ($researchRecords as $index => $records) {
				$research->data[] = $records;
			}

			return $research;
		}

		return null;
	}
}
