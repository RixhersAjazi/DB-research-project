<?php

/**
 * Class for mapping user objects to the databases
 */
class UserRepository
{
	/**
	 * @param User $user
	 */

   /**
    * Inserts user into databased based on an object
    */
	public function create($user)
	{
		$sql = "INSERT INTO user (`username`, `password`, `role`) VALUES (:username, :password, :email)";
		$db = new DB();
		$db->open();
		$db->insert(
			$sql,
			[':username' => $user->getUser(), ':password' => $user->getPassword(), ':email' => $user->getEmail()]
		);
		$db->close();
		return true;
	}

  /**
   * Connects a student and project based on passed in IDs
   */
	public function assignStudentToProject($studentId, $proejctId)
	{
		$sql = "INSERT INTO assginedProjects (`student_id`, `research_id`) VALUES (:studentId, :password, :researchId)";
		$db = new DB();
		$db->open();
		$db->insert(
			$sql,
			[':studentId' => $studentId, ':researchId' => $proejctId]
		);
		$db->close();
		return true;
	}

  /**
   * Gets data from a single user based on ID
   */
	public function get($userId)
	{
		$sql = "SELECT * FROM users WHERE id = :id";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $userId]);
		$db->close();
		return $results;
	}

  /**
   * Gets data of a user whose role is 'student'
   */
	public function getStudentData($studentId)
	{
		$sql = "SELECT users.id as userId, users.username as username, users.role as role, studentMeta.searching as searching, studentMeta.interests as interests FROM users WHERE id = :id AND role = 'student' INNER JOIN studentMeta ON studentMeta.id = users.id";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $studentId]);
		$db->close();
		return $results;
	}
}
