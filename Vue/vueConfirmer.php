<?php $this->titre = "Supprimer - " . $place['Adresse']; ?>

<article>
    <header>
        <p><h1>
            Effacer?
        </h1>
		<?= $place['auteur'] ?> dit :<br/>
        <strong><?= $place['Adresse'] ?></strong><br/>
        <?= $place['Description'] ?>
        </p>
    </header>
</article>

<form action="index.php?action=supprimer" method="post">
    <input type="hidden" name="id" value="<?= $place['id'] ?>" /><br />
    <input type="submit" value="Oui" />
</form>
<form action="index.php" method="get" >
	<input type="hidden" name="action" value="transaction" /> 
    <input type="hidden" name="id" value="<?= $place['transaction_id'] ?>" />
    <input type="submit" value="Annuler" />
</form>


