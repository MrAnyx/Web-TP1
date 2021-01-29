<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<h1 class="text-center mt-3">Historic</h1>

<div class="container-fluid mt-4 mb-4 px-4">

   <?php if(isset($_SESSION["user"])): ?>
    <div class="container-fluid mx-0 px-0 mb-4">
        <form method="GET">
            <div class="row justify-content-start">
                <div class="col-6 col-md-4 col-lg-2">
                    <select class="form-select" name="option" aria-label="Default select example">
                        <option value="start_date" <?php if(isset($_GET["option"]) && $_GET["option"] === "start_date") echo "selected"; ?>>Start date</option>
                        <option value="end_date" <?php if(isset($_GET["option"]) && $_GET["option"] === "end_date") echo "selected"; ?>>End date</option>
                        <option value="last_name" <?php if(isset($_GET["option"]) && $_GET["option"] === "last_name") echo "selected"; ?>>Last name</option>
                        <option value="first_name" <?php if(isset($_GET["option"]) && $_GET["option"] === "first_name") echo "selected"; ?>>First name</option>
                        <option value="computer" <?php if(isset($_GET["option"]) && $_GET["option"] === "computer") echo "selected"; ?>>Computer</option>
                    </select>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <input type="text" class="form-control" name="value" value="<?php if(isset($_GET["value"])) echo $_GET["value"]; ?>" placeholder="Search...">
                </div>
                <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                    <button class="btn btn-outline-primary w-25" type="submit" name="submit" value="search">Search</button>

                   <?php if(isset($_GET["value"])): ?>
                        <button class="btn btn-outline-warning w-25" type="submit" name="submit" value="reset">Reset</button>
                   <?php endif ?>

                </div>
            </div>
        </form>
    </div>
   <?php endif ?>



    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Last name</th>
                <th scope="col">First name</th>
                <th scope="col">Computer</th>

               <?php if(isset($_SESSION["user"])): ?>
                    <th scope="col">Options</th>
               <?php endif ?>

            </tr>
        </thead>
        <tbody>
            <?php foreach($loans as $loan): ?>
                <tr>
                    <th><?= $loan["id"] ?></th>
                    <td><?= $loan["date_loan"] ?></td>
                    <td><?= $loan["date_restitution"] ?></td>
                    <td><?= $loan["last_name"] ?></td>
                    <td><?= $loan["first_name"] ?></td>
                    <td><?= $loan["brand"]." - ".$loan["os"] ?></td>

                   <?php if(isset($_SESSION["user"])): ?>
                        <td><a href="<?= $this->router->generate("loanDetails", ["id" => $loan["id"]]) ?>" class="btn btn-sm btn-success">Details</a></td>
                   <?php endif ?>

                </tr>
            <?php endforeach ?>
        </tbody>
    </table>


</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
