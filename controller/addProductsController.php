<?php

require_once 'model/addProducts.php';
require_once 'view/view.php';

class AddProductsController {

    public function __construct() {
		$this->addProductsMdl = new AddProducts();
    }

	// Affiche la vue d'ajout d'un produit
    public function show() {
        $view = new View("addProducts");
        $view->generate(null);
    }

	// Ajoute le produit en base
	public function addProduct($name, $price, $image) {
		$this->addProductsMdl->addProduct($name, $price, $image);
	}

}
