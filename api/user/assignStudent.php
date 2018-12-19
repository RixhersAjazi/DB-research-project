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
	$session = new Session();
	$dataObj = new JsonDataObject();
	//if ($session::isLoggedIn()) {
		if (UserService::assignStudentToProject($postData)) {
			http_response_code(201);
			$dataObj->createResponse(['success' => 'Student assigned']);
		} else {
			http_response_code(500);
			$dataObj->createResponse(['error' => 'Could not process this request']);
		}
//	} else {
//		http_response_code(401);
//		$dataObj->createResponse(['error' => 'Not logged in']);
//	}
}

main($_POST);
