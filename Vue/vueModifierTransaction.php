<?php $this->titre = "Le Blogue de Marwane Rezgui - " . $transaction['retourInformation']; ?>

<header>
    <h1 id="titreReponses">Modifier une transaction de l'utilisateur 1 :</h1>
</header>
<form action="index.php?action=miseAJourTransaction" method="post">
    <h2>Modifier une transaction</h2>
    <p>
        <label for="Daate">Date</label> : <input type="date" name="Daate" id="Daate" value="<?= $transaction['Daate'] ?>" /> <br />
        <label for="Prix">Prix</label> :  <input type="number" name="Prix" id="Prix" value="<?= $transaction['Prix'] ?>" /><br />
        <label for="retourInformation">retour d'information</label> :  <textarea name="retourInformation" id="retourInformation" ><?= $transaction['retourInformation'] ?></textarea><br />
        <input type="hidden" name="utilisateur_id" value="1" /><br />
        <input type="hidden" name="id" value="<?= $transaction['id'] ?>" /><br />
        <input type="submit" value="Modifier" />
    </p>
</form>
<form action="index.php">
    <input type="submit" value="Annuler" />
</form>

