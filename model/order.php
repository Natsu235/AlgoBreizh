<?php

require_once("model.php");

class Order {

	private $_id;
	private $_creationDate;
	private $_state;
	private $_customerId;
	private $_content;

    public function __construct($data, $content) {
		$this->hydrate($data);
		$this->setContent($content);
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
	public function creationDate() { return $this->_creationDate; }
	public function state() { return $this->_state; }
	public function customer() { return $this->_customer; }
	public function content() { return $this->_content; }

 	public function setId($id) {
		$id = (int) $id;
		// On vérifie que l'id ne soit pas négatif
		if ($id > 0) {
			$this->_id = (int) $id;
		}
		else {
			throw new Exception("L'id est inférieur ou égal à 0 !");
		}
	}

	public function setCreationDate($date) {
		$this->_creationDate = $date;
	}

	public function setState($state) {
		$state = (int) $state;
		if ($state == 0 || $state == 1) {
			$this->_state = $state;
		}
	}

	public function setContent($content) {
		$this->_content = $content;
	}

	public function setid_tCustomers($customer) {
		$this->_customer = $customer;
	}

}
