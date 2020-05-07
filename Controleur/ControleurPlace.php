<?php

require_once 'Modele/Place.php';
require_once 'Vue/Vue.php';

class ControleurPlace {

    private $place;

    public function __construct() {
        $this->place = new Place();
    }

// Ajoute un Place à un transaction
    public function place($place) {
        $validation_courriel = filter_var($place['auteur'], FILTER_VALIDATE_EMAIL);
        if ($validation_courriel) {
            if (H204A4_PUBLIC) {
                $_SESSION['h204a4message'] = "Ajouter une place n'est pas permis en démonstration";
            } else {
                // Ajouter le place à l'aide du modèle
                $this->place->setPlace($place);
            }
            //Recharger la page pour mettre à jour la liste des places associés
            header('Location: index.php?action=transaction&id=' . $place['transaction_id']);
        } else {
            //Recharger la page avec une erreur près du courriel
            header('Location: index.php?action=transaction&id=' . $place['transaction_id'] . '&erreur=courriel');
        }
    }

// Confirmer la suppression d'un place
    public function confirmer($id) {
        // Lire le place à l'aide du modèle
        $place = $this->place->getPlace($id);
        $vue = new Vue("Confirmer");
        $vue->generer(array('place' => $place));
    }

// Supprimer un place
    public function supprimer($id) {
        // Lire le place afin d'obtenir le id de l'transaction associé
        $place = $this->place->getPlace($id);
        if (H204A4_PUBLIC) {
            $_SESSION['h204a4message'] = "Supprimer une place n'est pas permis en démonstration";
        } else {
            // Supprimer le place à l'aide du modèle
            $this->place->deletePlace($id);
        }
        //Recharger la page pour mettre à jour la liste des places associés
        header('Location: index.php?action=transaction&id=' . $place['transaction_id']);
    }

}
