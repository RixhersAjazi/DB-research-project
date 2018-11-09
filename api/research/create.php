<?php
require_once __DIR__ . '/../apiPostHeader.php';

function main($postData)
{
	$dataObj = new JsonDataObject();
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
}