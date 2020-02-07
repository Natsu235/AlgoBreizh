<?php

require_once('model/model.php');
require_once('model/product.php');

class ProductManager extends Model {

    // Renvoie la liste des commandes associés à un client
    public function get($id) {
        $req = 'SELECT * FROM product WHERE id = ?';
        $row = $this->executerRequete($req, array($id))->fetch();
        return new Product($row);
    }

    // Retourne l'ensemble des produits disponible en base
    public function getList() {
        $stack = array();
        $req = 'SELECT * FROM product WHERE 1';
        $result = $this->executerRequete($req)->fetchAll();
        foreach ($result as $row){
            $item = new Product($row);
            array_push($stack, $item);
        }
        return $stack;
    }

}
