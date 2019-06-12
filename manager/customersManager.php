<?php

require_once("model/model.php");
require_once('model/customer.php');

class CustomersManager extends Model {

	// Renvoie la un Customer sur le critére correspondant. Id/Username suivant la provenance de l'appel. Login/OrderInfo (Ex: qmz , 1)
	public function get($identifier) {
		$req = 'SELECT * FROM tCustomers WHERE ';
		if (is_string($identifier))	{
			$req = $req.'username=?';
		}
		else if(is_int($identifier)) {
			$req = $req.'id=?';
		}
		$result = $this->executerRequete($req, array($identifier))->fetch();
		if (is_array($result)){
			return new Customer($result);
		}
		else{
			return null;
		}
	}

	public function update($Customer) {
		$req = 'UPDATE tCustomers SET username = ?, firstname = ?, lastname = ?, password = ?, email = ?, enabled = ?, rights = ? WHERE username=?';
		$client = $this->executerRequete($req, array(
			$Customer->username(),
			$Customer->firstName(), 
			$Customer->lastName(),
			$Customer->password(),
			$Customer->email(),
			$Customer->enabled(),
			$Customer->userRights(),
			$Customer->username()
		));
	}

}
