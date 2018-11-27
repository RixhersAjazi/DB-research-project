<?php

/**
 * Class for users that is called by the API to call the repo methods to
 * interact with the database
 */

class UserService
{
  /**
   * For create
   */
	public static function create($postData)
	{
		$user = new User($postData);
		if (!$user->isValid()) {
			throw new InvalidDataException();
		}

		$userRepo = new UserRepository();
		if ($userRepo->create($user) !== false) {
			return $user->getArray();
		} else {
			return null;
		}
  }
  
  /**
   * For assigning to project
   */
	public static function assignStudentToProject($postData)
	{
		$userRepo = new UserRepository();
		return $userRepo->assignStudentToProject($postData->studentId, $postData->professorId);
  }
  
  /**
   * For getting student only data
   */
	public static function getStudentData($postData)
	{
		$userRepo = new UserRepository();
		return $userRepo->getStudentData($postData->studentId);
  }
  
  /**
   * For getting general user data
   */
	public static function get($userId)
	{
		$userData = (new UserRepository())->get($userId);
		if (!is_null($userData)) {
			return (new User($userData))->getArray();
		} else {
			return null;
		}
	}
}
