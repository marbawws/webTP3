<?php

require_once 'Modele/Transaction.php';
require_once 'Modele/Place.php';
require_once 'Vue/Vue.php';

class ControleurTransaction {

    private $transaction;
    private $place;

    public function __construct() {
        $this->transaction = new Transaction();
        $this->place = new Place();
    }

// Affiche la liste de tous les transactions du blog
    public function transactions() {
        $transactions = $this->transaction->getTransactions();
        $vue = new Vue("Transactions");
        $vue->generer(['transactions' => $transactions]);
    }

// Affiche les détails sur un transaction
    public function transaction($idTransaction, $erreur) {
        $transaction = $this->transaction->getTransaction($idTransaction);
        $places = $this->place->getPlaces($idTransaction);
        $vue = new Vue("Transaction");
        $vue->generer(['transaction' => $transaction, 'places' => $places, 'erreur' => $erreur]);
    }

    public function nouvelTransaction() {
        $vue = new Vue("Ajouter");
        $vue->generer();
    }

// Enregistre le nouvel transaction et retourne à la liste des transactions
    public function ajouter($transaction) {
        if (H204A4_PUBLIC) {
            $_SESSION['h204a4message'] = "Ajouter un transaction n'est pas permis en démonstration";
        } else {
            $this->transaction->setTransaction($transaction);
        }
        $this->transactions();
    }

// Modifier un transaction existant    
    public function modifierTransaction($id) {
        $transaction = $this->transaction->getTransaction($id);
        $vue = new Vue("ModifierTransaction");
        $vue->generer(['transaction' => $transaction]);
    }

// Enregistre l'transaction modifié et retourne à la liste des transactions
    public function miseAJourTransaction($transaction) {
        if (H204A4_PUBLIC) {
            $_SESSION['h204a4message'] = "Moddifier une transaction n'est pas permis en démonstration";
        } else {
            $this->transaction->updateTransaction($transaction);
        }
        $this->transactions();
    }

}
