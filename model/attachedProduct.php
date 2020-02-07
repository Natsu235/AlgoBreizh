<?php

require_once('model/product.php');

class AttachedProduct extends Product { 

    private $_quantity;

    public function __construct($data, $quantity) {
        parent::__construct($data);
        $this->hydrate($quantity);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set'.ucfirst($key);
            // Si le setter correspondant existe...
            if (method_exists($this, $method)) {
                // Alors, on l'appel
                $this->$method($value);
            }
        }
    }

    public function quantity() {
        return $this->_quantity;
    }

    public function setQuantity($quantity) {
        $this->_quantity = (int) $quantity;
    }

}
