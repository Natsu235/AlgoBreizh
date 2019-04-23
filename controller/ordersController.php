<?php

require_once 'model/order.php';
require_once 'view/view.php';
require_once 'manager/ordersManager.php';
include('fpdf181/invoice/ex.php');

class OrdersController {

    private $ordersManager;
    private $customersManager;

    public function __construct() {
        $this->ordersManager = new OrdersManager();    
        $this->customersManager = new CustomersManager();
	}

    // Affiche les commandes du client
    public function show($idClient) {
		if ($_SESSION["customer"]->Rights() == 1) {
			$orders = $this->ordersManager->getList();
			$view = new View("ordersAdmin");
			$view->generate(array('orders' => $orders));
		}
		else {
			$orders = $this->ordersManager->getListForClient($idClient);
			$view = new View("orders");
			$view->generate(array('orders' => $orders));
		}
	}

	// Affiche la commande selectionnée
    public function showOrder($orderId) {
		$order = $this->ordersManager->get($orderId);
		$view = new View("order");
		$view->generate(array('order' => $order));
	}

	// Génère la facture
    public function generatePDF($orderId) {
		printOrder($orderId);
	}

	// Valide la commande selectionnée
	public function validOrder($orderId) {
        $order = $this->ordersManager->get($orderId);
        $order->setState((int)1);
        $this->ordersManager->update($order);
        header('index.php?action=orders');
	}

}
