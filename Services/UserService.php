<?php

class UserService
{
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

	public static function assignStudentToProject($postData)
	{
		$userRepo = new UserRepository();
		return $userRepo->assignStudentToProject($postData->studentId, $postData->professorId);
	}

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
