<?php

namespace App;

use App\DB\DBConnection;

class FormSubmission
{
   private \PDO $db;
   private \AltoRouter $router;

   public function __construct(\AltoRouter $router)
   {
      $dbConnection = new DBConnection();
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
         $addEmprunt = $this->db->prepare("INSERT INTO Emprunt(id_user, id_computer, date_emprunt, etat, commentaire) VALUES (:id_user, :id_computer, :date_emprunt, :etat, :commentaire)");
         $addEmprunt->bindParam(":id_user", $_POST["emprunteur"]);
         $addEmprunt->bindParam(":id_computer", $_POST["ordinateur"]);
         $date_emprunt = (new \DateTime())->format("Y-m-d H:i:s");
         $addEmprunt->bindParam(":date_emprunt", $date_emprunt);
         $addEmprunt->bindParam(":etat", $_POST["etat"]);
         $comment = htmlspecialchars($_POST["commentaire"]);
         $addEmprunt->bindParam(":commentaire", $comment);
         $addEmprunt->execute();
         header("Location: {$this->router->generate("emprunt")}?info=success");
      }
   }

   public function empruntDetails_form(int $id) {
      $updateEmprunt = $this->db->prepare("UPDATE Emprunt SET date_restitution = :date_restitution WHERE id = :id");
      $date_restitution = (new \DateTime())->format("Y-m-d H:i:s");
      $updateEmprunt->bindParam(":date_restitution", $date_restitution);
      $updateEmprunt->bindParam(":id", $id);
      $updateEmprunt->execute();
      header("Location: {$this->router->generate("historique")}");
   }
}