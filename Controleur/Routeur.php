<?php

//Attention il s'agit d'identificateurs à portée globale alors les nom doivent être exclusifs
//Une constante nommée simplement "public" ne serait pas une bonne idée
define("H204A4_PUBLIC", false); //si public alors aucune modification permise à la BD
session_start(); // Le message à afficher dans le gabarit lorsque ce n'est pas permis sera dans $_SESSION['h204a4message']

require_once 'Controleur/ControleurTransaction.php';
require_once 'Controleur/ControleurPlace.php';
require_once 'Controleur/ControleurType.php';
require_once 'Vue/Vue.php';

class Routeur {

    private $ctrlTransaction;
    private $ctrlPlace;
    private $ctrlType;

    public function __construct() {
        $this->ctrlTransaction = new ControleurTransaction();
        $this->ctrlPlace = new ControleurPlace();
        $this->ctrlType = new ControleurType();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                // À propos
                if ($_GET['action'] == 'apropos') {
                    $this->apropos();
                } else if ($_GET['action'] == 'transaction') {
                    $id = intval($this->getParametre($_GET, 'id'));
                    if ($id != 0) {
                        // Vérifier si une erreur est présente
                        $erreur = isset($_GET['erreur']) ? $_GET['erreur'] : '';
                        $this->ctrlTransaction->transaction($id, $erreur);
                    } else
                        throw new Exception("Identifiant d'transaction non valide");
                } else if ($_GET['action'] == 'place') {
                    // Tester l'existence des paramètres requis
                    $transaction_id = intval($this->getParametre($_POST, 'transaction_id'));
                    if ($transaction_id != 0) {
                        $this->getParametre($_POST, 'Adresse');
                        $this->getParametre($_POST, 'Description');
                        $this->getParametre($_POST, 'auteur');
                        // Enregistrer le comentaire
                        $this->ctrlPlace->place($_POST);
                    } else
                        throw new Exception("Identifiant d'transaction non valide");
                } else if ($_GET['action'] == 'confirmer') {
                    $id = intval($this->getParametre($_GET, 'id'));
                    if ($id != 0) {
                        $this->ctrlPlace->confirmer($id);
                    } else
                        throw new Exception("Identifiant de place non valide");
                } else if ($_GET['action'] == 'supprimer') {
                    $id = intval($this->getParametre($_POST, 'id'));
                    if ($id != 0) {
                        $this->ctrlPlace->supprimer($id);
                    } else
                        throw new Exception("Identifiant de place non valide");
                } else if ($_GET['action'] == 'nouvelTransaction') {
                    $this->ctrlTransaction->nouvelTransaction();
                } else if ($_GET['action'] == 'ajouter') {
                    // Tester l'existence des paramètres requis
                    $utilisateur_id = intval($this->getParametre($_POST, 'utilisateur_id'));
                    if ($utilisateur_id != 0) {
                          $this->getParametre($_POST, 'Daate');
                          $this->getParametre($_POST, 'Prix');
                          $this->getParametre($_POST, 'retourInformation');
                        //$this->getParametre($_POST, 'type');
                        // Enregistrer l'transaction
                        $this->ctrlTransaction->ajouter($_POST);
                    } else
                        throw new Exception("Identifiant d'utilisateur non valide");
                } else if ($_GET['action'] == 'miseAJourTransaction') {
                    // Tester l'existence des paramètres requis
                    $id = intval($this->getParametre($_POST, 'id'));
                    if ($id != 0) {
                        $utilisateur_id = intval($this->getParametre($_POST, 'utilisateur_id'));
                        if ($utilisateur_id != 0) {
                            //Vérifier l'existence des paramètres
                            $this->getParametre($_POST, 'Daate');
                            $this->getParametre($_POST, 'Prix');
                            $this->getParametre($_POST, 'retourInformation');
                           // $this->getParametre($_POST, 'type');
                            // Enregistrer l'transaction
                            $this->ctrlTransaction->miseAJourTransaction($_POST);
                        } else
                            throw new Exception("Identifiant d'utilisateur non valide");
                    } else
                        throw new Exception("Identifiant d'transaction non valide");
                } else if ($_GET['action'] == 'modifierTransaction') {
                    $id = intval($this->getParametre($_GET, 'id'));
                    if ($id != 0) {
                        $this->ctrlTransaction->modifierTransaction($id);
                    } else
                        throw new Exception("Identifiant d'transaction non valide");
                } else if ($_GET['action'] == 'quelsTypes') {
                    $term = $this->getParametre($_GET, 'term');
                    $this->ctrlType->quelsTypes($term);
                } else {
                    throw new Exception("Action non valide");
                }
            } else // aucune action définie : affichage des transactions par défaut
                $this->ctrlTransaction->transactions();
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    // Affiche une explication de l'application
    private function apropos() {
        $vue = new Vue("Apropos");
        $vue->generer();
    }

    // Affiche une erreur
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        } else
            throw new Exception("Paramètre '$nom' absent");
    }

}
