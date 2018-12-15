<?php
require_once __DIR__ . '/../../Services/UserService.php';
require_once __DIR__ . '/../../Lib/JsonDataObject.php';
require_once __DIR__ . '/../apiGetHeader.php';

/**
 * Sets up HTTP response when getting all data
 */
function main()
{
	$allProfs = UserService::getAllProfessors();
	if (!is_null($allProfs)) {
		http_response_code(201);
		JsonDataObject::createResponse($allProfs);
	} else {
		http_response_code(200);
		JsonDataObject::createResponse(['error' => 'Could not process requests']);
	}
}

main();
