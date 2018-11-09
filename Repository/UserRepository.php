<?php

class UserRepository
{
	/**
	 * @param User $user
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

	public function get($userId)
	{
		$sql = "SELECT * FROM users WHERE id = :id";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $userId]);
		$db->close();
		return $results;
	}
}
