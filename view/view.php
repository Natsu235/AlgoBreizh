<?php

class View {

    // Nom du fichier associé à la vue
    private $file;

    // Titre de la vue (défini dans le fichier vue)
    private $title;

	// Scripts de la vue (défini dans le fichier vue)
	private $scripts;

	// Statuts de la session
	private $logged;
	private $admin;

    public function __construct($action) {
        // Détermination du nom du fichier vue à partir de l'action
        $this->file = "view/" . $action . "View.php";
		$this->logged = isset($_SESSION["customer"]);
        if(isset($_SESSION["customer"])){
			$this->admin = $_SESSION["customer"]->Rights() == 1;
		}
    }

	// Affiche la vue correspondante
	public function generate($data) {
        // Génération de la partie spécifique de la vue
        $content = $this->generateFile($this->file, $data);
		// Génération du gabarit commun utilisant la partie spécifique
		$view = $this->generateFile('view/template.php', array(
			'title' => $this->title,
			'content' => $content,
			'scripts' => $this->scripts,
			'logged' => $this->logged,
			'admin' => $this->admin
		));
        // Renvoi de la vue au navigateur
        echo $view;
    }

    // Génère le contenu de la vue
    private function generateFile($file, $data) {
        if (file_exists($file)) {
			if ($data != null){
			    extract($data);
			}	
            ob_start();
            require $file;
            return ob_get_clean();
        }
        else {
            throw new Exception(serialize([
				'error' => "Fichier '$file' introuvable.",
				'file' => __FILE__,
				'function' => __FUNCTION__,
			]));
		}
    }

}
