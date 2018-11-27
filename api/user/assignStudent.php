<?php
require_once __DIR__ . '/../apiPostHeader.php';

/**
 * Sets up HTTP response when assigning student to project
 */
function main($postData)
{
	$dataObj = new JsonDataObject();
	if (UserService::assignStudentToProject($postData)) {
		http_response_code(201);
	} else {
		http_response_code(500);
		$dataObj->createResponse(['error' => 'Could not process this request']);
	}
}
