<?php

use App\DB\DBConnection;

require_once __DIR__ . "/bootstrap.php";

$router = new AltoRouter();

// routes
$router->map("GET", "/", "App\ViewClass#home", "home");

$router->map("GET", "/login", "App\ViewClass#login", "login");
$router->map("POST", "/login/submit", "App\FormSubmission#login_form", "login_form");

$router->map("GET", "/historic", "App\ViewClass#historic", "historic");

$router->map("GET", "/loan", "App\ViewClass#loan", "loan");
$router->map("POST", "/loan/submit", "App\FormSubmission#loan_form", "loan_form");

$router->map("GET", "/logout", "App\ViewClass#logout", "logout");

$router->map("GET", "/loan/details/[i:id]", "App\ViewClass#loanDetails", "loanDetails");
$router->map("POST", "/loan/detail/[i:id]/submit", "App\FormSubmission#loanDetails_form", "loanDetails_form");

$match = $router->match();

// Matcher d'url
if ($match === false) { // Si la route n'existe pas
   header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
} else if(is_string($match["target"])) { // Si l'attribut 'target' est une string
   list($controller, $function) = explode('#', $match['target']);
   if (is_callable(array(new $controller($router), $function))) { // On vérifie si la fonction associée à la classe peut être appelée
      call_user_func_array(array(new $controller($router),$function), $match['params']);
   } else {
      header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
   }
} else {
   header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
