<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<?php
$stmt = $db->prepare("SELECT e.date_emprunt, e.date_restitution, c.nom, c.prenom, o.brand, o.os FROM Emprunt as e INNER JOIN Customer as c ON e.id_user = c.id INNER JOIN Computer as o ON e.id_computer = o.id ORDER BY e.date_restitution");
$stmt->execute();
$emprunts = $stmt->fetchAll();
?>

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
                </tr>
            </thead>
            <tbody>
                <?php foreach($emprunts as $key => $emprunt): ?>
                    <tr>
                        <th><?= $key ?></th>
                        <td><?= $emprunt["date_emprunt"] ?></td>
                        <td><?= $emprunt["date_restitution"] ?></td>
                        <td><?= $emprunt["nom"] ?></td>
                        <td><?= $emprunt["prenom"] ?></td>
                        <td><?= $emprunt["brand"]." - ".$emprunt["os"] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>


    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
