<nav class="navbar navbar-expand-md navbar-light bg-light">
   <div class="container-fluid">
      <a class="navbar-brand" href="<?= $router->generate("accueil") ?>">3iEmprunt</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="<?= $router->generate("historique") ?>">Historique</a></li>

            <?php if(isset($_SESSION["user"])): ?>
                <li class="nav-item"><a class="nav-link" href="<?= $router->generate("emprunt") ?>">Nouvel emprunt</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $router->generate("logout") ?>">Déconnexion</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="<?= $router->generate("login") ?>">Login</a></li>
            <?php endif ?>

         </ul>
      </div>
   </div>
</nav>