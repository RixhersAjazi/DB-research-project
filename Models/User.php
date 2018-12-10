<?php

require_once __DIR__ . '/../Models/Validator.php';
require_once __DIR__ . '/../Models/ArrayAble.php';

/**
 * User class. Users have a username, email, and password tied to the 
 * account.
 * Also has a role which differentiates between students and faculty.
 */
class User implements Validator, ArrayAble
{
	private $user;
	private $password;
	private $role;
	private $name;
	private $id;

	public function __construct($data)
	{
		if ($data instanceof stdClass) {
			$this->user = $data->username;
			$this->password = $data->password;
			$this->role = $data->role;
			$this->name = $data->name;
			$this->id = $data->id ?: 0;
		} else {
			$this->user = $data['username'];
			$this->password = $data['password'];
			$this->role = $data['role'];
			$this->name = $data['name'];
			$this->id = array_key_exists('id', $data) ?: 0;
		}
	}

  /**
   * Checks if the user's properties align with the table constraints
   */
	public function isValid()
	{
		if (!isset($this->user) || !isset($this->password) || !isset($this->role) || !isset($this->name)) {
			return false;
		}

		if (!is_string($this->user) || strlen($this->password) > 20) {
			return false;
		}

		if (!is_string($this->password) || strlen($this->password) > 20) {
			return false;
		}

		if (!is_string($this->role) || !in_array($this->role, ['prof', 'student'])) {
			return false;
		}

		return true;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
   * Gets username
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return null
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param null $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return null
   * Gets user password
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @return null
   * Gets user role (faculty or student)
	 */
	public function getRole()
	{
		return $this->role;
	}

  /**
   * Returns user's properties as an array
   */
	public function getArray()
	{
		return
		[
			'user' => $this->user,
			'role' => $this->role,
			'name' => $this->name,
			'password' => $this->password,
			'id' => $this->id
		];
	}
}
