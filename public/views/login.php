<?php require __DIR__ . "/../layout/header.php"; ?>

<h1 class="text-center mt-3">Connectez vous</h1>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 col-md-8 col-lg-6 mt-4" id="form-container">
            <form method="POST" action="<?= $this->router->generate("login_form") ?>">

                <?php if(isset($_GET["error"]) && $_GET["error"] === "no_account"): ?>
                    <?php require __DIR__ . "/components/alert/errors/account_not_found.php"; ?>
                <?php elseif(isset($_GET["error"]) && $_GET["error"] === "credentials"): ?>
                    <?php require __DIR__ . "/components/alert/errors/invalid_credentials.php" ?>
                <?php endif ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input type="text" class="form-control" id="email" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" name="submit" class="btn btn-outline-primary mt-3">Me connecter</button>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
