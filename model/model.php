<?php

require_once('config_smtp.php');

/**
 * Classe abstraite Model.
 * Centralise les services d'accès à une base de données.
 * Utilise l'API PDO
 */

abstract class Model {

    /** Objet PDO d'accès à la BDD */
    private $bdd;

    public function __construct($data) {
        $this->hydrate($data);
    }

    /**
     * Exécute une requête SQL éventuellement paramétrée
     * 
     * @param string $sql La requête SQL
     * @param array $valeurs Les valeurs associées à la requête
     * @return PDOStatement Le résultat renvoyé par la requête
     */
    protected function executerRequete($sql, $params = null) {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql);	// exécution directe
        }
        else {
            $resultat = $this->getBdd()->prepare($sql);	// requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }

    /**
     * Renvoie un objet de connexion à la BDD en initialisant la connexion au besoin
     * 
     * @return PDO L'objet PDO de connexion à la BDD
     */
    private function getBdd() {
        if ($this->bdd == null) {
            // Création de la connexion
            $this->bdd = new PDO('mysql:host=w1kr9ijlozl9l79i.chr7pe7iynqr.eu-west-1.rds.amazonaws.com;dbname=rfysaixx5duuce25;port=3306;charset=utf8', 'ixvj1vei7e0y4psa', 'gf627yddnauxn3pv', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->bdd;
    }

}
