<?php

require_once('manager/orderManager.php');
require_once('model/order.php');
require_once('view/view.php');
include('fpdf181/invoice/ex.php');

class OrderController {

    private $orderManager;
    private $customerManager;

    public function __construct() {
        $this->orderManager = new OrderManager();    
        $this->customerManager = new CustomerManager();
    }

    // Affiche les commandes du client
    public function show($idClient) {
        if ($_SESSION['customer']->Rights() == 1) {
            $orders = $this->orderManager->getList();
            $view = new View('orderAdmin');
            $view->generate(array('order' => $orders));
        }
        else {
            $orders = $this->orderManager->getListForClient($idClient);
            $view = new View('order');
            $view->generate(array('order' => $orders));
        }
    }

    // Affiche la commande selectionnée
    public function showOrder($orderId) {
        $order = $this->orderManager->get($orderId);
        $view = new View('order');
        $view->generate(array('order' => $order));
    }

    // Génère la facture
    public function generatePDF($orderId) {
        printOrder($orderId);
    }

    // Valide la commande selectionnée
    public function validOrder($orderId) {
        $order = $this->orderManager->get($orderId);
        $order->setState((int)1);
        $this->orderManager->update($order);
        header('index.php?action=order');
    }

}
