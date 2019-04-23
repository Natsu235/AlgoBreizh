<?php
require_once 'model/order.php';
require_once 'view/view.php';
require_once 'manager/productsManager.php';

class ProductsController {

    private $productsManager;

    public function __construct() {
        $this->productsManager = new ProductsManager();   
    }

    // Affiche la boutique
    public function show() {
        $products = $this->productsManager->getList();
        $view = new View("products");
        $view->generate(array('products' => $products));
    }

}
