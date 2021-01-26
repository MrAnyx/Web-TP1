<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<?php
$stmt = $db->prepare("SELECT e.id, e.date_emprunt, e.date_restitution, e.commentaire, c.nom, c.prenom, o.brand, o.os, o.cpu, o.ram, e.etat FROM Emprunt as e INNER JOIN Customer as c ON e.id_user = c.id INNER JOIN Computer as o ON e.id_computer = o.id WHERE e.id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$emprunt = $stmt->fetch();
?>

<h1 class="text-center mt-3">Détails</h1>


<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-6 mt-4" id="form-container">
            <form method="POST" action="<?= $router->generate("empruntDetails_form", ["id" => $id]) ?>">

               <?php if(isset($_GET["info"]) && $_GET["info"] === "success"): ?>
                  <?php require __DIR__ . "/components/alert/success/success.php"; ?>
               <?php endif ?>

                <div class="mb-3">
                    <label for="emprunteur" class="form-label">Emprunteur</label>
                    <input type="text" value="<?= $emprunt["nom"]." ".$emprunt["prenom"] ?>" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="ordinateur" class="form-label">Ordinateur</label>
                    <input type="text" value="<?= $emprunt["brand"]." - ".$emprunt["os"]." - ".$emprunt["cpu"]." - ".$emprunt["ram"] ?>" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Etat</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="neuf" value="neuf" disabled <?= $emprunt["etat"] === "neuf" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="neuf">Neuf</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="bon_etat" value="bon_etat" disabled <?= $emprunt["etat"] === "bon_etat" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="bon_etat">Bon état</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="usage" value="usage" disabled <?= $emprunt["etat"] === "usage" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="usage">Usagé</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="commentaire" rows="3" name="commentaire" readonly  style="max-height:150px"><?= $emprunt["commentaire"] ?></textarea>
                </div>

               <?php if($emprunt["date_restitution"] === null): ?>
                    <button type="submit" name="submit" class="btn btn-outline-primary mt-3">Terminer l'emprunt</button>
               <?php endif ?>
            </form>
        </div>
    </div>
</div>


<?php require __DIR__ . "/../layout/footer.php"; ?>
