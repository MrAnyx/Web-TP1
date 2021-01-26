<?php

use App\DB\DBConnection;

require_once __DIR__ . "/bootstrap.php";

$router = new AltoRouter();

$dbConnection = new DBConnection();
$db = $dbConnection->getDB();

$router->map("GET", "/", function() use($router, $db){
   require __DIR__ . "/views/accueil.php";
}, "accueil");

$router->map("GET", "/login", function() use($router, $db){
   if(isset($_SESSION["user"])) {
      header("Location: {$router->generate("accueil")}");
   }else {
      require __DIR__ . "/views/login.php";
   }
}, "login");
$router->map("POST", "/login/submit", "App\FormSubmission#login_form", "login_form");

$router->map("GET", "/historique", function() use($router, $db){
   require __DIR__ . "/views/historique.php";
}, "historique");

$router->map("GET", "/emprunt", function() use($router, $db){
   if(!isset($_SESSION["user"])) {
      header("Location: {$router->generate("accueil")}");
   }else {
      require __DIR__ . "/views/emprunt.php";
   }
}, "emprunt");
$router->map("POST", "/emprunt/submit", "App\FormSubmission#emprunt_form", "emprunt_form");

$router->map("GET", "/logout", function() use($router, $db){
   session_unset();
   session_destroy();
   header("Location: {$router->generate("accueil")}");
}, "logout");

$router->map("GET", "/emprunt/details/[i:id]", function(int $id) use($router, $db){
   if(!isset($_SESSION["user"])) {
      header("Location: {$router->generate("accueil")}");
   }else {
      require __DIR__ . "/views/empruntDetails.php";
   }
}, "empruntDetails");
$router->map("POST", "/emprunt/detail/[i:id]/submit", "App\FormSubmission#empruntDetails_form", "empruntDetails_form");

$match = $router->match();

if ($match === false) {
   header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
} else if(is_string($match["target"])) {
   list($controller, $function) = explode('#', $match['target']);
   if (is_callable(array(new $controller($router), $function))) {
      call_user_func_array(array(new $controller($router),$function), $match['params']);
   } else {
      header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
   }
} else if(is_object($match["target"]) && is_callable($match["target"])) {
   call_user_func_array($match["target"], $match["params"]);
} else {
   header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
