<?php

class JsonDataObject
{
	public static function getData()
	{
		return json_decode(file_get_contents("php://input"));
	}

	public static function createResponse($responseArray)
	{
		echo json_encode($responseArray);
	}
}
