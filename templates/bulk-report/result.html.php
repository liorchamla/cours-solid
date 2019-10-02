<div class="alert alert-light">
    <h1 class="alert-title">Voici votre rapport dans divers formats</h1>
</div>

<?php foreach ($results as $report) : ?>
    <?= $report ?>
    <hr />
<?php endforeach ?>