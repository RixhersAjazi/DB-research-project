<?php
require_once __DIR__ . '/../apiGetHeader.php';

/**
 * Sets up HTTP response when getting user data
 */
function main($userId)
{
	$user = UserService::get($userId);

	if (!is_null($user)) {
		http_response_code(200);
		JsonDataObject::createResponse($user);
	} else {
		http_response_code(200);
		JsonDataObject::createResponse(['error' => 'That user does not exist']);
	}
}
