<?php
require_once __DIR__ . '/../../Services/ResearchService.php';
require_once __DIR__ . '/../../Lib/JsonDataObject.php';
require_once __DIR__ . '/../../Lib/Session.php';
require_once __DIR__ . '/../apiPostHeader.php';
/**
 * Sets up HTTP response when creating data
 */
function main($postData)
{
	$session = new Session();
	$dataObj = new JsonDataObject();

//	if ($session::isLoggedIn()) {
		try {
			$research = ResearchService::create($postData);

			if (is_array($research)) {
				http_response_code(201);
				$dataObj->createResponse($research);
			} else {
				http_response_code(500);
				$dataObj->createResponse(['error' => 'Could not process this request']);
			}
		} catch (InvalidDataException $e) {
			http_response_code(400);
			$dataObj->createResponse(['error' => 'Invalid post data']);
		}
//	} else {
//		http_response_code(401);
//		$dataObj->createResponse(['error' => 'Not logged in']);
//	}
}

main($_POST);
