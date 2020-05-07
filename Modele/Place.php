<?php

require_once 'Modele/Modele.php';

/**
 * Fournit les services d'accès aux genres musicaux 
 * 
 * @author Baptiste Pesquet et Marwane Rezgui
 */
class Place extends Modele {

    // Renvoie la liste des places associés à une transaction
    public function getPlaces($idTransaction) {
        $sql = 'select * from places'
                . ' where transaction_id = ?';

        $places = $this->executerRequete($sql, [$idTransaction]);
        return $places;
    }

// Renvoie une place spécifique
    public function getPlace($id) {
        $sql = 'select * from places'
                . ' where id = ?';
        $place = $this->executerRequete($sql, [$id]);
        if ($place->rowCount() == 1) {
            return $place->fetch();  // Accès à la première ligne de résultat
        } else {
            throw new Exception("Aucune place ne correspond à l'identifiant '$id'");
        }
    }

// Supprime une place
    public function deletePlace($id) {
        $sql = 'UPDATE places'
                . ' SET efface = 1'
                . ' WHERE id = ?';
        $result = $this->executerRequete($sql, [$id]);
        return $result;
    }

// Ajoute une place associés à un transaction
    public function setPlace($place) {
        $sql = 'INSERT INTO places (Adresse, Description, auteur, transaction_id) VALUES(?, ?, ?, ?)';
        $result = $this->executerRequete($sql, [$place['Adresse'], $place['Description'], $place['auteur'], $place['transaction_id']]);
        return $result;
    }

}
