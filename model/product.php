<?php

class Product {

    private $_id;
    private $_name;
    private $_price;
    private $_reference;

    public function __construct($data) {
        $this->hydrate($data);
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

    public function id() { return $this->_id; }
    public function name() { return $this->_name; }
    public function price() { return $this->_price; }
    public function reference() { return $this->_reference; }

    public function setId($id) {
        $this->_id = (int) $id;
    }

    public function setName($name){
        if (is_string($name) && strlen($name) <= 255) {
            $this->_name = $name;
        }
    }

    public function setPrice($price){
        $this->_price = $price;
    }

    public function setReference($reference) {
        if (is_string($reference) && strlen($reference)) {
            $this->_reference = $reference;
        }
    }

}
