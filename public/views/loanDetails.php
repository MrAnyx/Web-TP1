<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<h1 class="text-center mt-3">Details</h1>

<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-6 mt-4" id="form-container">
            <form method="POST" action="<?= $this->router->generate("loanDetails_form", ["id" => $id]) ?>">

               <?php if(isset($_GET["info"]) && $_GET["info"] === "success"): ?>
                  <?php require __DIR__ . "/components/alert/success/success.php"; ?>
               <?php endif ?>

                <div class="mb-3">
                    <label for="customer" class="form-label">Customer</label>
                    <select class="form-select" name="customer" id="customer" required aria-label="Select a customer">
                       <?php foreach($customers as $customer): ?>
                           <option value="<?= $customer["id"] ?>" <?= $customer["id"] === $loan["id_user"] ? "selected" : "" ?>><?= $customer["last_name"]." ".$customer["first_name"] ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="computer" class="form-label">Computer</label>
                    <select class="form-select" name="computer" id="computer" required aria-label="Select a computer">
                       <?php foreach($computers as $computer): ?>
                           <option value="<?= $computer["id"] ?>" <?= $computer["id"] === $loan["id_computer"] ? "selected" : "" ?>><?= $computer["brand"]." - ".$computer["os"]." - ".$computer["cpu"]." - ".$computer["ram"] ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">State</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="new" value="new" <?= $loan["state"] === "new" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="new">New</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="good" value="good" <?= $loan["state"] === "good" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="good">Good</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="state" id="used" value="used" <?= $loan["state"] === "used" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="used">Used</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date_start" class="form-label">Date start</label>
                    <input class="form-control" type="datetime-local" id="date_start" name="date_start" required value="<?= (new DateTime($loan["date_loan"]))->format("Y-m-d\TH:i") ?>">
                </div>

               <?php if($loan["date_restitution"] !== null): ?>
                    <div class="mb-3">
                        <label for="date_end" class="form-label">Date end</label>
                        <input class="form-control" type="datetime-local" id="date_end" name="date_end" required value="<?= (new DateTime($loan["date_restitution"]))->format("Y-m-d\TH:i") ?>">
                    </div>
               <?php endif ?>

                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment" rows="3" name="comment"  style="max-height:150px"><?= $loan["comment"] ?></textarea>
                </div>

               <?php if($loan["date_restitution"] === null): ?>
                    <button type="submit" name="submit" class="btn btn-outline-success mt-3">Loan ending</button>
               <?php endif ?>
                <?php if(isset($_SESSION["user"])): ?>
                    <button type="submit" name="update" class="btn btn-outline-primary mt-3">Update loan</button>
               <?php endif ?>
            </form>
        </div>
    </div>
</div>


<?php require __DIR__ . "/../layout/footer.php"; ?>
