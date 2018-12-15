<?php

require_once __DIR__ . '/../../Lib/JsonDataObject.php';
require_once __DIR__ . '/../../Services/UserService.php';
require_once __DIR__ . '/../apiPostHeader.php';

/**
 * Sets up HTTP response when creating user
 */
function main($postData)
{
	$dataObj = new JsonDataObject();
	try {
		UserService::delete($postData);
		http_response_code(202);
		$dataObj->createResponse(['success' => 'User deleted']);
	} catch (Exception $e) {
		http_response_code(204);
		$dataObj->createResponse(['error' => 'User delete request could not be processed']);
	}
}

main($_POST);
