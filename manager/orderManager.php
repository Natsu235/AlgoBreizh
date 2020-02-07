<?php

require_once('model/attachedProduct.php');
require_once('model/model.php');
require_once('model/order.php');

class OrderManager extends Model {

    // Mise a jour d'une commande
    public function update($order) {
        $req = 'UPDATE order SET state = ?, creation_date = ? WHERE id = ?';
        $this->executerRequete($req, array($order->state(), $order->creation_date(), $order->id()));
        return true;
    }

    // Ajout d'une commande
    public function add($order) {
        $req = 'INSERT INTO order(state, creation_date, id_customer) VALUES (?, ?, ?)';    
        $this->executerRequete($req, array($order->state(), $order->creation_date(), $order->customer()->id()));
        $stmt = $this->executerRequete('SELECT LAST_INSERT_ID()', NULL);
        $lastId = $stmt->fetchColumn();
        foreach ($order->content() as $attProduct){
            $productReq = 'INSERT INTO order_product (quantity, id_order, id_product) VALUES (?, ?, ?)';
            $this->executerRequete($productReq, array($attProduct->quantity(),$lastId,$attProduct->id()));
        }
        return true;
    }

    // Retourne toutes les commandes du client correspondant
    function getListForClient($clientId) {
        $stack = array();
        $req = 'SELECT * FROM order WHERE id_customer = ? ORDER BY creation_date DESC';
        $result = $this->executerRequete($req,array($clientId))->fetchAll();
        foreach ($result as $row) {
            $row = $this->executerRequete('SELECT * FROM order WHERE id = ?', array($row['id']))->fetch();
            $userRow = $this->executerRequete('SELECT 1 FROM customer WHERE id = ?', array($row['id_customer']))->fetch();
            $row['id_customer'] = new Customer($userRow);
            $itm = new Order($row, $this->getContent($row['id']));
            array_push($stack, $itm);
        }
        return $stack;
    }

   // Retourne un object de type Order
    function get($orderId) {
        $row = $this->executerRequete('SELECT * FROM order WHERE id = ?', array($orderId))->fetch();
        $userRow = $this->executerRequete('SELECT * FROM customer WHERE id = ?', array($row['id_customer']))->fetch();
        $row['id_customer'] = new Customer($userRow);

        $order = new Order($row, $this->getContent($row['id']));
        return $order;
    }

   // Retourne toutes les commandes sous forme de tableau
    function getList() {
        $stack = array();
        $req = 'SELECT * FROM order WHERE state = 0 ORDER BY creation_date';
        $result = $this->executerRequete($req)->fetchAll();
        foreach ($result as $row) {
            $userRow = $this->executerRequete('SELECT 1 FROM customer WHERE id = ?', array($row['id_customer']))->fetch();
            $row['id_customer'] = new Customer($userRow);
            $itm = new Order($row,$this->getContent($row['id']));
            array_push($stack, $itm);
        }
        return $stack;
    }

    // Retourne le contenu de la commande sous forme de tableau
       private function getContent($orderId) {
        $content = array();
        $req = "SELECT quantity, id_product FROM order_product WHERE id_order = ?";
        $orderLines = $this->executerRequete($req, array($orderId));
        $lines = $orderLines->fetchAll(PDO::FETCH_ASSOC);
        for($i = 0; $i < count($lines); $i++) {
            $productsRow = $this->executerRequete("SELECT * FROM product WHERE id = ?", array($lines[$i]['id_product']))->fetch(PDO::FETCH_ASSOC);
            $content[$i] = new AttachedProduct($productsRow, array('quantity' => $lines[$i]['quantity']));
        }
        return $content;
    }

}
