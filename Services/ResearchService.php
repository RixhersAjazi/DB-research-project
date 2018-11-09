<?php

class ResearchService
{
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

	public static function get($researchId)
	{
		$researchData = (new ResearchRepository())->get($researchId);
		if (!is_null($researchData)) {
			return (new User($researchData))->getArray();
		} else {
			return null;
		}
	}
}
