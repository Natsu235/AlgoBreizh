<?php

require_once('manager/cartManager.php');
require_once('view/view.php');

class CartController {

    private $cartManager;
    private $orderManager;

    public function __construct() {
        $this->cartManager = new CartManager();
        $this->orderManager = new OrderManager();
    }

    // Affiche la boutique
    public function show() {
        $view = new View('cart');
        $view->generate(array('cart' => $this->cartManager->get()));
    }    

    // Ajoute un article au panier
    public function addToCart($producId, $quantity, $output) {
        if ($this->cartManager->add($producId, $quantity))
            $return['code'] = 'success';
        else
            $return['code'] = 'error';
        if ($output)
            echo json_encode($return);
        else
            $this->show();
    }

    // Retire un article du panier
    public function removeFromCart($producId) {
        $this->cartManager->delete($producId);
        header('Location: index.php?action=cart');
    }

    // Vide le panier
    public function clearCart() {
        $this->cartManager->deleteAll();
        header('Location: index.php?action=cart');
    }

    // Valide la commande
    public function checkOut() {
        $order = new Order(array(
            'id' => 1,
            'creation_date' => date('Y-m-d H:i:s'),
            'id_customer' => $_SESSION['customer'],
            'state' => '0'
        ),
        $this->cartManager->get());
        $this->orderManager ->add($order);
        $this->cartManager->deleteAll();
        header('Location: index.php?action=orders');
    }

}
