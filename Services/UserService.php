<?php

require_once __DIR__ . '/../Repository/UserRepository.php';
require_once __DIR__ . '/../Lib/Session.php';
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Exceptions/InvalidDataException.php';

/**
 * Class for users that is called by the API to call the repo methods to
 * interact with the database
 */

class UserService
{
	public static function logUserIn($postData)
	{
		$user = self::getByUsername($postData['username']);

		if ($user != null && password_verify($postData['password'], $user['password'])) {
			(new Session())::login();
			return $user['id'];
		}

		return false;
	}

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

  public static function delete($deleteData)
  {
  	$userRepo = new UserRepository();
  	return $userRepo->delete($deleteData['userId']);
  }
  
  /**
   * For assigning to project
   */
	public static function assignStudentToProject($postData)
	{
		$userRepo = new UserRepository();
		return $userRepo->assignStudentToProject($postData['studentId'], $postData['researchId']);
    }
  
  /**
   * For getting student only data
   */
	public static function getStudentData($userId)
	{
		$returnData = [];
		$userRepo = new UserRepository();
		$returnData['studentData'] = $userRepo->getStudentData($userId);
		$returnData['research'] = $userRepo->getStudentResearch($userId);
		$returnData['interests'] = $userRepo->getStudentInterests($userId);

		return $returnData;
  }

	/**
	 * For getting student only data
	 */
	public static function getProfes($userId)
	{
		$returnData = [];
		$userRepo = new UserRepository();
		$returnData['studentData'] = $userRepo->getStudentData($userId);
		$returnData['research'] = $userRepo->getStudentResearch($userId);
		$returnData['interests'] = $userRepo->getStudentInterests($userId);

		return $returnData;
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

	/**
	 * For getting general user data
	 */
	public static function getByUsername($username)
	{
		$userData = (new UserRepository())->getByUsername($username);
		if (!is_null($userData)) {
			return (new User($userData))->getArray();
		} else {
			return null;
		}
	}

	public static function updateStudent($postData)
	{
		return (new UserRepository())->updateStudent($postData['studentId'], $postData['searching'], json_encode($postData['interests']), $postData['bio']);
	}

	public static function getAllStudents()
	{
		$studentRecords = (new UserRepository())->getAllStudents();
		$students = [];

		if (!is_null($studentRecords)) {
			/**
			 * @var User $record
			 */
			foreach ($studentRecords as $index => $records) {
				$students[$records['userId']]['studentData'] = $records;
				$students[$records['userId']]['research'][] = (new UserRepository())->getStudentResearch($records['userId']);
			}

			return $students;
		}

		return null;
	}

	public static function getAllProfessors()
	{
		$profRecoords = (new UserRepository())->getAllProfessors();
		$prof = [];

		if (!is_null($profRecoords)) {
			/**
			 * @var User $record
			 */
			foreach ($profRecoords as $index => $records) {
				$prof[$records['id']]['prof'] = $records;
			}

			return $prof;
		}

		return null;
	}
}
