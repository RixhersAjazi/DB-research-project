<?php

class User implements Validator, ArrayAble
{
	private $user;
	private $email;
	private $password;
	private $role;

	public function __construct($data)
	{
		$this->user = $data->user;
		$this->email = $data->email ?: null;
		$this->password = $data->password ?: null;
		$this->role = $data->role ?: null;
	}

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
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * @return null
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @return null
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @return null
	 */
	public function getRole()
	{
		return $this->role;
	}

	public function getArray()
	{
		return
		[
			'user' => $this->user,
			'email' => $this->email,
			'role' => $this->role,
			'password' => '****'
		];
	}
}
