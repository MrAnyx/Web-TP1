<?php require __DIR__ . "/../layout/header.php"; ?>
<?php require __DIR__ . "/components/navbar.php"; ?>

<h1 class="text-center mt-3">Historic</h1>

<div class="container-fluid mt-4 mb-4 px-4">
    <div class="table-responsive-lg">

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
</div>

<?php require __DIR__ . "/../layout/footer.php"; ?>
