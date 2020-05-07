<?php $this->titre = 'Le Blogue de Marwane Rezgui'; ?>

<a href="index.php?action=nouvelTransaction">
    <h2 class="titreTransaction">Ajouter une transaction</h2>
</a>
<?php foreach ($transactions as $transaction):
    ?>

    <article>
        <header>
            <a href="index.php?action=transaction&id=<?= $transaction['id'] ?>">
                <h1 class="titreTransaction"><?= $transaction['Daate'] ?></h1>
            </a>
            <time><?= $transaction['Daate'] ?></time>, par utilisateur #<?= $transaction['utilisateur_id'] ?>
        </header>
        <p><?= $transaction['Prix'] ?><br/>
            <?= $transaction['retourInformation'] ?>
            <a href="index.php?action=modifierTransaction&id=<?= $transaction['id'] ?>"> [modifier la transaction]</a>
        </p>
    </article>
    <hr />
<?php endforeach; ?>    
