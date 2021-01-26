<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<?php
$stmt = $db->prepare("SELECT id, nom, prenom FROM Customer ORDER BY nom");
$stmt->execute();
$customers = $stmt->fetchAll();

$stmt = $db->prepare("SELECT id, brand, os, cpu, ram FROM Computer ORDER BY brand ASC");
$stmt->execute();
$computers = $stmt->fetchAll();
?>

<h1 class="text-center mt-3">Emprunt</h1>


<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-6 mt-4" id="form-container">
            <form method="POST" action="<?= $urlGenerator->generate("emprunt_form") ?>">

               <?php if(isset($_GET["info"]) && $_GET["info"] === "success"): ?>
                  <?php require __DIR__ . "/components/alert/success/success.php"; ?>
               <?php elseif(isset($_GET["error"]) && $_GET["error"] === "invalid_date"): ?>
                  <?php require __DIR__ . "/components/alert/errors/invalid_date.php"; ?>
               <?php endif ?>

                <div class="mb-3">
                    <label for="emprunteur" class="form-label">Emprunteur</label>
                    <select class="form-select" name="emprunteur" id="emprunteur" aria-label="Selectionnez une personne">
                       <?php foreach($customers as $customer): ?>
                            <option value="<?= $customer["id"] ?>"><?= $customer["nom"]." ".$customer["prenom"] ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ordinateur" class="form-label">Ordinateur</label>
                    <select class="form-select" name="ordinateur" id="ordinateur" aria-label="Selectionnez un ordinateur">
                       <?php foreach($computers as $computer): ?>
                           <option value="<?= $computer["id"] ?>"><?= $computer["brand"]." - ".$computer["os"]." - ".$computer["cpu"]." - ".$computer["ram"] ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date_debut">Date début</label>
                    <input type="date" id="date_debut" class="form-control mt-2" name="date_debut" value="<?= (new DateTime())->format("Y-m-d") ?>" min="<?= (new DateTime())->format("Y-m-d") ?>">
                </div>
                <div class="mb-3">
                    <label for="date_fin">Date Fin</label>
                    <input type="date" id="date_fin" class="form-control mt-2" name="date_fin" value="<?= (new DateTime())->modify("+1 day")->format("Y-m-d") ?>" min="<?= (new DateTime())->modify("+1 day")->format("Y-m-d") ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Etat</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etat" id="neuf" value="neuf" checked>
                        <label class="form-check-label" for="neuf">Neuf</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etat" id="bon_etat" value="bon_etat">
                        <label class="form-check-label" for="bon_etat">Bon état</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="etat" id="usage" value="usage">
                        <label class="form-check-label" for="usage">Usagé</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="commentaire" class="form-label">Commentaire</label>
                    <textarea class="form-control" id="commentaire" rows="3" name="commentaire" style="max-height:150px"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-outline-primary mt-3">Emprunter</button>
            </form>
        </div>
    </div>
</div>


<?php require __DIR__ . "/../layout/footer.php"; ?>
