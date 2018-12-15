<?php

require_once __DIR__ . '/DB.php';

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
		$sql = "INSERT INTO users (`username`, `password`, `role`, `name`) VALUES (:username, :password, :role, :name)";
		$db = new DB();
		$db->open();
		$db->execute(
			$sql,
			[':username' => $user->getUser(), ':password' => password_hash($user->getPassword(), PASSWORD_DEFAULT), ':role' => $user->getRole(), ':name' => $user->getName()]
		);

		if ($user->getRole() === 'student') {
			$sql = "INSERT INTO studentMeta (`id`) VALUES (:id)";
			$db = new DB();
			$db->open();
			$db->execute(
				$sql,
				[':id' => $user->getId()]
			);

			$sql = "INSERT INTO studentRatings (`studentId`) VALUES (:id)";
			$db = new DB();
			$db->open();
			$db->execute(
				$sql,
				[':id' => $user->getId()]
			);
		}

		$db->close();
		return true;
	}

	public function delete($userId)
	{
		$sql = "DELETE FROM users WHERE id = :id";
		$db = new DB();
		$db->open();
		$db->execute($sql, [':id' => $userId]);
		$db->close();
		return true;
	}

	public function getByUsername($username)
	{
		$sql = "SELECT * FROM users WHERE username = :username";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':username' => $username]);
		$db->close();
		return $results;
	}

	public function getById($userId)
	{
		$sql = "SELECT * FROM users WHERE id = :id";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $userId]);
		$db->close();
		return $results;
	}

  /**
   * Connects a student and project based on passed in IDs
   */
	public function assignStudentToProject($studentId, $projectId)
	{
		$sql = "INSERT INTO assignedProjects (`student_id`, `research_id`) VALUES (:studentId, :researchId)";
		$db = new DB();
		$db->open();
		$db->execute(
			$sql,
			[':studentId' => $studentId, ':researchId' => $projectId]
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
		$sql = "
					SELECT 
						users.id as userId, 
						users.username as username, 
						users.role as role, 
					  	users.name as name,
						studentMeta.searching as searching,  
						studentRatings.rating as rating,
						studentMeta.bio as bio,
						studentMeta.gradDate as gradDate
					FROM users 
					LEFT JOIN studentMeta ON studentMeta.id = users.id
					LEFT JOIN studentRatings ON studentRatings.student_id = users.id
					WHERE users.id = :id AND role = 'student';";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $studentId]);
		$db->close();
		return $results;
	}

	public function getStudentResearch($studentId)
	{
		$sql = "
					SELECT 
					  	research.name as researchName,
					  	research.description as researchDescription,
					  	research.category as researchCategory,
					  	research.results as researchResults
					FROM users 
					LEFT JOIN assignedProjects ON assignedProjects.student_id = users.id
					LEFT JOIN research ON research.research_id = assignedProjects.research_id
					WHERE users.id = :id AND role = 'student';";
		$db = new DB();
		$db->open();
		$results = $db->getAll($sql, [':id' => $studentId]);
		$db->close();
		return $results;
	}

	public function getResearch($profId)
	{
		$sql = "
					SELECT 
					  	research.name as researchName,
					  	research.description as researchDescription,
					  	research.category as researchCategory,
					  	research.results as researchResults
					FROM research
					WHERE professor_id = :id;";
		$db = new DB();
		$db->open();
		$results = $db->getAll($sql, [':id' => $profId]);
		$db->close();
		return $results;
	}

	public function getStudentInterests($userId)
	{
		$sql = "SELECT studentMeta.interests as interests FROM studentMeta WHERE id = :id LIMIT 1";
		$db = new DB();
		$db->open();
		$results = $db->get($sql, [':id' => $userId]);
		$db->close();

		if (isset($results->interests)) {
			return json_decode($results->interests);
		}

		return [];
	}

	public function getAllStudents()
	{
		$sql = "
					SELECT 
						users.id as userId, 
						users.username as username, 
						users.role as role,
						users.name as name,  
						studentMeta.searching as searching, 
						studentMeta.interests as interests, 
						studentRatings.rating as rating,
						studentMeta.bio as bio,
						studentMeta.gradDate as gradDate
					FROM users 
					LEFT JOIN studentMeta ON studentMeta.id = users.id
					LEFT JOIN studentRatings ON studentRatings.student_id = users.id
					WHERE role = 'student';";

		$db = new DB();
		$db->open();
		$results = $db->getAll($sql);
		$db->close();
		return $results;
	}

	public function getAllProfessors()
	{
		$sql = "
				SELECT
					id,
					username,
					name
				FROM users 
				WHERE role = 'prof';
		";

		$db = new DB();
		$db->open();
		$results = $db->getAll($sql);
		$db->close();
		return $results;
	}

	public function updateStudent($userId, $searching, $interests, $bio)
	{
		$sql = "
			UPDATE studentMeta SET `searching` = :searching, `interests` = :interests, `bio` = :bio WHERE id = :id
		";

		$db = new DB();
		$db->open();
		$db->execute($sql, [':id' => $userId, ':searching' => $searching, ':interests' => $interests, ':bio' => $bio]);
		$db->close();
		return true;
	}
}
