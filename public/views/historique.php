<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<h1 class="text-center mt-3">Historique</h1>

<div class="container-fluid mt-4 mb-4 px-4">
    <div class="table-responsive-lg">

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date début</th>
                    <th scope="col">Date fin</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Ordinateur</th>

                   <?php if(isset($_SESSION["user"])): ?>
                        <th scope="col">Options</th>
                   <?php endif ?>

                </tr>
            </thead>
            <tbody>
                <?php foreach($emprunts as $emprunt): ?>
                    <tr>
                        <th><?= $emprunt["id"] ?></th>
                        <td><?= $emprunt["date_emprunt"] ?></td>
                        <td><?= $emprunt["date_restitution"] ?></td>
                        <td><?= $emprunt["nom"] ?></td>
                        <td><?= $emprunt["prenom"] ?></td>
                        <td><?= $emprunt["brand"]." - ".$emprunt["os"] ?></td>

                       <?php if(isset($_SESSION["user"])): ?>
                            <td><a href="<?= $this->router->generate("empruntDetails", ["id" => $emprunt["id"]]) ?>" class="btn btn-sm btn-success">Détails</a></td>
                       <?php endif ?>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>


    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
