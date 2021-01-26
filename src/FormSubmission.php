<?php

namespace App;

use App\DB\DBConnection;

class FormSubmission
{
   private \PDO $db;
   private \AltoRouter $router;

   public function __construct(\AltoRouter $router)
   {
      $dbConnection = new DBConnection("127.0.0.1", "secret", "homestead", "TP_1", "3306");
      $this->db = $dbConnection->getDB();
      $this->router = $router;
   }

   public function login_form() {
      if(isset($_POST["submit"])) {
         $stmt = $this->db->prepare("SELECT * FROM User WHERE username = :username");
         $stmt->bindParam("username", $_POST["username"]);
         $stmt->execute();
         $result = $stmt->fetch();

         if(empty($result)) {
            header("Location: {$this->router->generate("login")}?error=no_account");
         } else {
            if(password_verify($_POST["password"], $result["password"])) {
               $_SESSION["user"] = $result;
               header("Location: {$this->router->generate("accueil")}");
            } else {
               header("Location: {$this->router->generate("login")}?error=credentials");
            }
         }
      }
   }

   public function emprunt_form() {
      if(isset($_POST["submit"])) {
         if(strtotime($_POST["date_debut"]) > strtotime($_POST["date_fin"])) {
            header("Location: {$this->router->generate("emprunt")}?error=invalid_date");
            die();
         }
         $addEmprunt = $this->db->prepare("INSERT INTO Emprunt(id_user, id_computer, date_emprunt, date_restitution, etat, commentaire) VALUES (:id_user, :id_computer, :date_emprunt, :date_restitution, :etat, :commentaire)");
         $addEmprunt->bindParam(":id_user", $_POST["emprunteur"]);
         $addEmprunt->bindParam(":id_computer", $_POST["ordinateur"]);
         $addEmprunt->bindParam(":date_emprunt", $_POST["date_debut"]);
         $addEmprunt->bindParam(":date_restitution", $_POST["date_fin"]);
         $addEmprunt->bindParam(":etat", $_POST["etat"]);
         $comment = htmlspecialchars($_POST["commentaire"]);
         $addEmprunt->bindParam(":commentaire", $comment);
         $addEmprunt->execute();

         header("Location: {$this->router->generate("emprunt")}?info=success");

      }
   }
}