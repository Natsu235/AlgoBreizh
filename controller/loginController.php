<?php

require_once('manager/customerManager.php');
require_once('view/view.php');

class LoginController {

    private $customerManager;
    private $welcomeCtrl;

    public function __construct() {
        $this->customerManager = new CustomerManager();
    }

    // Affiche la page d'authentification / d'inscription
    public function show($action) {
        $view = new View($action);
        $view->generate(null);
    }

    // Authentification
    public function login($username, $password) {
        $password = sha1($password);
        $customer = $this->customerManager->get($username);
        if ($customer != null){
            if ($customer->password() == $password && $customer->enabled() == 1) {
                $_SESSION['customer'] = $customer;
                $this->show('welcome');
                return;
            }
        }
        $this->show('login');
    }

    // Inscription
    public function register($username, $email) {
        $password = $this->generateRandomString(5);
        $customer = $this->customerManager->get($username);
        if ($customer != null) {
            if ($customer->enabled() == 1) {
                return;
            }
            $customer->setPassword(sha1($password));
            $customer->setEmail($email);
            $customer->setEnabled(1);
            $this->customerManager->update($customer);
            $subject = 'AlgoBreizh - Inscription';
            $message = 'Mot de passe: '.$password;
            $headers = 'From: client@algobreizh.com' . '\r\n' .
            'Reply-To: client@algobreizh.com' . '\r\n' .
            'X-Mailer: PHP/' . phpversion();
            mail($email, $subject, $message, $headers);
        }
    }

    private function generateRandomString($length = 10) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($characters);
        $randomStr = '';
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomStr;
    }

}
