<?php
/**
 * Class for JSON objects, can get data and create responses
 */
class JsonDataObject
{
  // Gets JSON data
	public static function getData()
	{
		return json_decode(file_get_contents("php://input"));
	}
  // Creates response from a data array
	public static function createResponse($responseArray)
	{
		echo json_encode($responseArray);
	}
}
