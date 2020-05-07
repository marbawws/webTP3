<?php $this->titre = "Le Blogue de Marwane Rezgui - Ajouter une transaction" . $transaction['Daate']; ?>

<article>
    <header>
        <h1 class="titreTransaction"><?= $transaction['Daate'] ?></h1>
        <time><?= $transaction['Daate'] ?></time>, par utilisateur #<?= $transaction['utilisateur_id'] ?>
    </header>
    <p><?= $transaction['Prix'] ?></p>
    <p><?= $transaction['retourInformation'] ?></p>
</article>
<hr />
<header>
    <h1 id="titreReponses">Réponses à <?= $transaction['Daate'] ?> :</h1>
</header>
<?= ($places->rowCount() == 0) ? '<span style="color : green;">Pas encore de places pour cette transaction.</span>' : '' ?>
<?php foreach ($places as $place): ?>
    <?php if ($place['efface'] == '0') : ?>
        <p><a href="index.php?action=confirmer&id=<?= $place['id'] ?>" >
                [Effacer]
            </a>
            <?= $place['auteur'] ?> dit : <br/>
			<strong><?= $place['Adresse'] ?></strong><br/>
			<?= $place['Description'] ?>	
        </p>
    <?php endif; ?>
<?php endforeach; ?>

<form action="index.php?action=place" method="post">
    <h2>Ajouter une place</h2>
    <p>
		<label for="auteur">Courriel de l'auteur (xxx@yyy.zz)</label> : <input type="text" name="auteur" id="auteur" /> 
        <?= ($erreur == 'courriel') ? '<span style="color : red;">Entrez un courriel valide s.v.p.</span>' : '' ?> 
        <br />
        <label for="texte">Adresse</label> :  <input type="text" name="Adresse" id="Adresse" /><br />
        <label for="texte">Description</label> :  <textarea type="text" name="Description" id="Description" >Écrivez la description ici</textarea><br />
        <input type="hidden" name="transaction_id" value="<?= $transaction['id'] ?>" /><br />
        <input type="submit" value="Envoyer" />
    </p>
</form>


