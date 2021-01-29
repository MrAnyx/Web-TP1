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
                    <input type="text" id="customer" value="<?= $loan["last_name"]." ".$loan["first_name"] ?>" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label for="computer" class="form-label">Computer</label>
                    <input type="text" id="computer" value="<?= $loan["brand"]." - ".$loan["os"]." - ".$loan["cpu"]." - ".$loan["ram"] ?>" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">State</label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="new" value="new" disabled <?= $loan["state"] === "new" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="new">New</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="good" value="good" disabled <?= $loan["state"] === "good" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="good">Good</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="used" value="used" disabled <?= $loan["state"] === "used" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="used">Used</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment</label>
                    <textarea class="form-control" id="comment" rows="3" name="comment" readonly  style="max-height:150px"><?= $loan["comment"] ?></textarea>
                </div>

               <?php if($loan["date_restitution"] === null): ?>
                    <button type="submit" name="submit" class="btn btn-outline-primary mt-3">Loan ending</button>
               <?php endif ?>
            </form>
        </div>
    </div>
</div>


<?php require __DIR__ . "/../layout/footer.php"; ?>
