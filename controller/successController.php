<?php

require_once 'view/view.php';

class SuccessController {

	// Affiche la vue de succès
    public function show() {
        $view = new View("success");
        $view->generate(null);
    }

}
