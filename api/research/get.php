<?php
require_once  __DIR__. '/../../autoload.php';
require_once __DIR__ . '/../apiGetHeader.php';

/**
 * Sets up HTTP response when getting data
 */
function main($researchId)
{
	$research = ResearchService::get($researchId);

	if (!is_null($research)) {
		http_response_code(201);
		JsonDataObject::createResponse($research);
	} else {
		http_response_code(200);
		JsonDataObject::createResponse(['error' => 'That user does not exist']);
	}
}

main($_GET['researchId']);
