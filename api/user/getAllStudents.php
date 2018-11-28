<?php
require_once __DIR__ . '/../../Services/UserService.php';
require_once __DIR__ . '/../../Lib/JsonDataObject.php';
require_once __DIR__ . '/../apiGetHeader.php';

/**
 * Sets up HTTP response when getting all data
 */
function main()
{
	$allStudents = UserService::getAllStudents();
	if (!is_null($allStudents)) {
		http_response_code(201);
		JsonDataObject::createResponse($allStudents);
	} else {
		http_response_code(200);
		JsonDataObject::createResponse(['error' => 'That user does not exist']);
	}
}

main();
