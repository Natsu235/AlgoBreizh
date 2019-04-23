<?php

require 'controller/router.php';

// Redirige l'action vers le routeur
$router = new Router();
$router->routerRequest();
