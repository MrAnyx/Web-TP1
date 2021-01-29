<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<h1 class="text-center mt-3">Loan</h1>

<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-6 mt-4" id="form-container">
            <form method="POST" action="<?= $this->router->generate("loan_form") ?>">

               <?php if(isset($_GET["info"]) && $_GET["info"] === "success"): ?>
                  <?php require __DIR__ . "/components/alert/success/success.php"; ?>
               <?php endif ?>

                <div class="mb-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select class="form-select" name="customer" id="customer" aria-label="Selectionnez une personne">
                       <?php foreach($customers as $customer): ?>
                            <option value="<?= $customer["id"] ?>"><?= $customer["last_name"]." ".$customer["first_name"] ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="computer" class="form-label">Computer</label>
                    <select class="form-select" name="computer" id="computer" aria-label="Selectionnez un ordinateur">
                       <?php foreach($computers as $computer): ?>
                           <option value="<?= $computer["id"] ?>"><?= $computer["brand"]." - ".$computer["os"]." - ".$computer["cpu"]." - ".$computer["ram"] ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">State</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="new" value="new" checked>
                        <label class="form-check-label" for="new">New</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="good" value="good">
                        <label class="form-check-label" for="good">Good</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="used" value="used">
                        <label class="form-check-label" for="used">Used</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment" rows="3" name="comment" style="max-height:150px"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-outline-primary mt-3">Loan</button>
            </form>
        </div>
    </div>
</div>


<?php require __DIR__ . "/../layout/footer.php"; ?>
