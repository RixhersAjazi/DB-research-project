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

	public function __construct($data)
	{
		$this->user = $data->username;
		$this->password = $data->password ?: null;
		$this->role = $data->role ?: null;
	}

  /**
   * Checks if the user's properties align with the table constraints
   */
	public function isValid()
	{
		if (!isset($this->user) || !isset($this->password) || !isset($this->role) || !isset($this->email)) {
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

		if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			return false;
		}

		return true;
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
   * Gets user email
	 */
	public function getEmail()
	{
		return $this->email;
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
			'password' => '****'
		];
	}
}
