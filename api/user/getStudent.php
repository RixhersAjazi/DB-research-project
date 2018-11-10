<?php
require_once __DIR__ . '/../apiGetHeader.php';

/**
 * Sets up HTTP response when getting data for a student
 */
function main($userId)
{
	$user = UserService::getStudentData($userId);

	if (!is_null($user)) {
		http_response_code(200);
		JsonDataObject::createResponse($user);
	} else {
		http_response_code(200);
		JsonDataObject::createResponse(['error' => 'Cant retrieve response']);
	}
}
