<?php
require_once __DIR__ . '/../apiPostHeader.php';

/**
 * Sets up HTTP response when creating user
 */
function main($postData)
{
	$dataObj = new JsonDataObject();
	try {
		$user = UserService::create($postData);

		if (is_array($user)) {
			http_response_code(201);
			$dataObj->createResponse($user);
		} else {
			http_response_code(500);
			$dataObj->createResponse(['error' => 'Could not process this request']);
		}
	} catch (InvalidDataException $e) {
		http_response_code(400);
		$dataObj->createResponse(['error' => 'Invalid post data']);
	}
}