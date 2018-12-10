<?php
require_once __DIR__ . '/../../Services/UserService.php';
require_once __DIR__ . '/../../Lib/JsonDataObject.php';
require_once __DIR__ . '/../../Lib/Session.php';
require_once __DIR__ . '/../apiPostHeader.php';

/**
 * Sets up HTTP response when assigning student to project
 */
function main($postData)
{
	$dataObj = new JsonDataObject();
	$userId = UserService::logUserIn($postData);
	if ($userId !== false) {
		http_response_code(201);
		$dataObj->createResponse(['success' => 'User logged in', 'id' => $userId]);
	} else {
		http_response_code(401);
		$dataObj->createResponse(['error' => 'Could not process this request']);
	}
}

main($_POST);
