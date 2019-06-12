<?php

require_once("model/model.php");
require_once 'model/order.php';
require_once 'model/attachedProduct.php';

class OrdersManager extends Model {

	// Mise a jour d'une commande
	public function update($Order) {
		$req = "UPDATE tOrders SET state = ?, creationDate = ? WHERE id = ?";
		$this->executerRequete($req, array($Order->state(), $Order->creationDate(), $Order->id()));
		return true;
	}

	// Ajout d'une commande
	public function add($Order) {
		$req = "INSERT INTO `tOrders`(`state`, `creationDate`, `id_tCustomers`) VALUES (?,?,?)";	
		$this->executerRequete($req, array($Order->state(), $Order->creationDate(), $Order->customer()->id()));
		$stmt = $this->executerRequete("SELECT LAST_INSERT_ID()", NULL);
		$lastId = $stmt->fetchColumn();
		foreach ($Order->content() as $attProduct){
			$productReq = "INSERT INTO tOrders_products (quantity,id_tOrders,id_tProducts) VALUES (?,?,?)";
			$this->executerRequete($productReq, array($attProduct->quantity(),$lastId,$attProduct->id()));
		}
		return true;
	}

	// Retourne toutes les commandes du client correspondant
	function getListForClient($clientId) {
		$stack = array();
		$req = 'SELECT * FROM tOrders WHERE id_tCustomers = ? ORDER BY creationDate DESC';
		$result = $this->executerRequete($req,array($clientId))->fetchAll();
		foreach ($result as $row) {
			$row = $this->executerRequete('SELECT * FROM tOrders WHERE id = ?', array($row['id']))->fetch();
			$userRow = $this->executerRequete('SELECT 1 FROM tCustomers WHERE id = ?', array($row['id_tCustomers']))->fetch();
			$row['id_tCustomers'] = new Customer($userRow);
			$itm = new Order($row, $this->getContent($row['id']));
			array_push($stack, $itm);
		}
		return $stack;
	}

   // Retourne un object de type Order
	function get($orderId) {
		$row = $this->executerRequete('SELECT * FROM tOrders WHERE id = ?', array($orderId))->fetch();
		$userRow = $this->executerRequete('SELECT * FROM tCustomers WHERE id = ?', array($row['id_tCustomers']))->fetch();
		$row['id_tCustomers'] = new Customer($userRow);

		$order = new Order($row, $this->getContent($row['id']));
		return $order;
    }

   // Retourne toutes les commandes sous forme de tableau
    function getList() {
		$stack = array();
		$req = "SELECT * FROM tOrders WHERE state = 0 ORDER BY creationDate";
		$result = $this->executerRequete($req)->fetchAll();
		foreach ($result as $row) {
			$userRow = $this->executerRequete('SELECT 1 FROM tCustomers WHERE id = ?', array($row['id_tCustomers']))->fetch();
			$row['id_tCustomers'] = new Customer($userRow);
			$itm = new Order($row,$this->getContent($row['id']));
			array_push($stack, $itm);
		}
		return $stack;
    }

	// Retourne le contenu de la commande sous forme de tableau
   	private function getContent($OrderId) {
		$content = array();
		$req = "SELECT quantity, id_tProducts FROM tOrders_products WHERE id_tOrders = ?";
        $orderLines = $this->executerRequete($req, array($OrderId));
		$lines = $orderLines->fetchAll(PDO::FETCH_ASSOC);
		for($i = 0; $i < count($lines); $i++) {
			$productsRow = $this->executerRequete("SELECT * FROM tProducts WHERE id = ?", array($lines[$i]['id_tProducts']))->fetch(PDO::FETCH_ASSOC);
			$content[$i] = new AttachedProduct($productsRow, array('quantity' => $lines[$i]['quantity']));
		}
		return $content;
	}

}
