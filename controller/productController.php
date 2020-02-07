<?php

require_once('manager/productManager.php');
require_once('model/order.php');
require_once('view/view.php');

class ProductController {

    private $productManager;

    public function __construct() {
        $this->productManager = new ProductManager();   
    }

    // Affiche la boutique
    public function show() {
        $products = $this->productManager->getList();
        $view = new View('product');
        $view->generate(array('products' => $products));
    }

}
