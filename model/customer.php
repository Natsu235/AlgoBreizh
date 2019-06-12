<?php

class Customer {

	private $_id;
	private $_firstName;
	private $_lastName;
	private $_userName;
	private $_password;
	private $_email;
	private $_enabled;
	private $_rights;

	public function __construct($data) {
		$this->hydrate($data);
	}

	public function hydrate(array $data) {
  		foreach ($data as $key => $value) {
    		// On récupère le nom du setter correspondant à l'attribut
    		$method = 'set'.ucfirst($key);
    		// Si le setter correspondant existe...
			if (method_exists($this, $method)) {
				// Alors, on appel le setter
				$this->$method($value);
			}
  		}
	}

	public function id() { return $this->_id; }
	public function firstName() { return $this->_firstName; }
	public function lastName() { return $this->_lastName; }
	public function username() { return $this->_userName; }
	public function password() { return $this->_password; }
	public function email() { return  $this->_email; }
	public function enabled() { return $this->_enabled; }
	public function rights() { return  $this->_rights; }

	public function setId($id){
		$this->_id = (int) $id;
	}

	public function setFirstName($firstname) {
		if (is_string($firstname) && strlen($firstname) <= 255) {
			$this->_firstName = $firstname;
		}
	}

	public function setLastName($lastname) {
		if (is_string($lastname) && strlen($lastname) <= 255) {
			$this->_lastName = $lastname;
		}
	}

	public function setUsername($username) {
		if (is_string($username) && strlen($username) == 3) {
			$this->_userName = $username;
		}
	}

	public function setPassword($password) {
		if (is_string($password) && strlen($password) <= 255) {
			$this->_password = $password;
		}
	}

	public function setEmail($email){
		if (is_string($email) && strlen($email) <= 255) {
			$this->_email = $email;
		}
	}
	  
	public function setEnabled($enabled){
		$this->_enabled = (int) $enabled;
	}

	public function setRights($rights){
		$rights = (int) $rights;
		$this->_rights = $rights;
	}

}
