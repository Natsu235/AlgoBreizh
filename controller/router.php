<?php

require_once 'controller/loginController.php';
require_once 'controller/productsController.php';
require_once 'controller/cartController.php';
require_once 'controller/ordersController.php';
require_once 'controller/addProductsController.php';
require_once 'controller/successController.php';
require_once 'view/view.php';

class Router {

	// Contrôleurs
	private $loginCtrl;
	private $productsCtrl;
	private $cartCtrl;
	private $ordersCtrl;
	private $addProductsCtrl;
	private $successCtrl;

    public function __construct() {
		session_start();
		$this->loginCtrl = new LoginController();
		$this->productsCtrl = new ProductsController();
		$this->cartCtrl = new CartController();
		$this->ordersCtrl = new OrdersController();
		$this->addProductsCtrl = new AddProductsController();
		$this->successCtrl = new SuccessController();
    }

    // Redirige l'action vers le routeur correspondant
    public function routerRequest() {
        try {
			// Vérifie si la session du client est connectée
			$isLogged = isset($_SESSION["customer"]);
			if (!isset($_GET['action'])) {
				$this->loginCtrl->show("welcome");
				return;
			}
			// Affiche la page d'authentification / d'inscription
			if ($_GET['action'] == 'login' or $_GET['action'] == 'register' ) {
				if (isset($_POST['username']) && isset($_POST['password'])) {
					$username = $this->getParameter($_POST,'username');
					$password =	$this->getParameter($_POST,'password');
					$this->loginCtrl->login($username,$password);
				}
				else if (isset($_POST['username']) && isset($_POST['email'])) {
					$username = $this->getParameter($_POST,'username');
					$email =	$this->getParameter($_POST,'email');
					$this->loginCtrl->register($username,$email);	
					$this->loginCtrl->show('login');
				}
				else {
					$this->loginCtrl->show($_GET['action']);
				}
				return;
			}
			if (!$isLogged) {
				$this->loginCtrl->show("welcome");
				return;
			}
			// Affiche la vue d'ajout d'un produit
			if ($_GET['action'] == 'addProducts') {
				$this->addProductsCtrl->show();
			}
			// Affiche la vue de succès
			if ($_GET['action'] == 'success') {
				$this->successCtrl->show();
			}
			// Ajoute le produit en base
			if ($_GET['action'] == 'addProduct') {
				try {
					$name = $this->getParameter($_POST,'name');
					$price = $this->getParameter($_POST,'price');
					$image = $this->getParameter($_POST,'image');
					$this->addProductsCtrl->addProduct($name, $price, $image);
					header("Location: index.php?action=success");
				}
				catch (Exception $e) {
					$data = unserialize($e->getMessage());
					if (is_array($data)) {
						$this->showError($data);
					}
					else {
						$this->showError($e->getMessage());
					}
				}
			}
			// Affiche la boutique
			if ($_GET['action'] == 'products') {
				$this->productsCtrl->show();
			}
			// Déconnecte la session du client
			else if ($_GET['action'] == 'logout') {
				session_destroy();
				header("Location: index.php");
			}
			// Affiche le panier du client
			else if ($_GET['action'] == 'cart') {
				$this->cartCtrl->show();
			}
			// Ajoute l'article sélectionné au panier
			else if ($_GET['action'] == 'addToCart' ) {
				if (isset($_GET['productId']) && isset($_GET['quantity']) && isset($_GET['output'])) {
					$this->cartCtrl->addToCart($this->getParameter($_GET,'productId'), $this->getParameter($_GET,'quantity'),$this->getParameter($_GET,'output'));
				}
			}
			// Retire l'article sélectionné du panier
			else if ($_GET['action'] == 'removeFromCart') {
				if (isset($_GET['productId'])) {
					$this->cartCtrl->removeFromCart($this->getParameter($_GET,'productId'));
				}
			}
			// Retire tous les articles du panier
			else if ($_GET['action'] == 'clearCart') {
				$this->cartCtrl->clearCart();
			}
			// Affiche le message d'erreur spécifique au panier
			else if ($_GET['action'] == 'checkOut') {
				$this->cartCtrl->checkOut();
			}
			// Affiche les commandes du client
			else if ($_GET['action'] == 'orders') {
				$this->ordersCtrl->show($_SESSION['customer']->id());
			}
			// Affiche la commande passée en paramètre
			else if ($_GET['action'] == 'order') {
				if (isset($_GET['order'])) {
					$orderId = $this->getParameter($_GET,'order');	
					$this->ordersCtrl->showOrder($orderId);	
				}
			} 
			// Affiche la facture de la commande
			else if ($_GET['action'] == 'generatePdf') {
				$this->ordersCtrl->generatePDF($this->getParameter($_GET, 'orderId'));
			} 
			// Valide une commande
			else if ($_GET['action'] == 'valid') {
				$this->ordersCtrl->validOrder($this->getParameter($_GET, 'orderId'));
				$this->ordersCtrl->show($_SESSION['customer']->id());
			}
			// Affiche les informations de la session connectée
			else if ($_GET['action'] == 'isUserLogged') {
					if (isset($_SESSION['customer'])) {
						$return['firstname'] = $_SESSION['customer']->firstName();
						$return['lastname'] = $_SESSION['customer']->lastName();
						$return['code'] = 'logged';
					}
					else {
						$return['code'] = 'notLogged';
					}
					echo json_encode($return);
					exit;
			}
			// Redirige vers la page d'accueil (si l'action n'existe pas)
			else {
				$this->loginCtrl->show("welcome");
			}
        }
		// Affiche l'erreur rencontrée
        catch (Exception $e) {
			$data = unserialize($e->getMessage());
			if (is_array($data)) {
				$this->showError($data);
			}
			else {
				$this->showError($e->getMessage());
			}
        }
	}

	// Retourne le paramètre d'un tableau
	private function getParameter($table, $name) {
        if (isset($table[$name])) {
            return $table[$name];
		}
        else {
            throw new Exception(serialize([
				'error' => "Paramètre '$name' non défini.",
				'file' => __FILE__,
				'function' => __FUNCTION__,
			]));
		}
    }

    // Affiche une erreur
    private function showError($message) {
        $view = new View("error");
        $view->generate(array('message' => $message));
    }

}
