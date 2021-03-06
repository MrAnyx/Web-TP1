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
               $_SESSION["user"] = $result["username"];
               header("Location: {$this->router->generate("home")}");
            } else {
               header("Location: {$this->router->generate("login")}?error=credentials");
            }
         }
      }
   }

   public function loan_form() {
      if(isset($_POST["submit"])) {
         $addLoan = $this->db->prepare("INSERT INTO Loan(id_user, id_computer, date_loan, state, comment) VALUES (:id_user, :id_computer, :date_loan, :state, :comment)");
         $addLoan->bindParam(":id_user", $_POST["customer"]);
         $addLoan->bindParam(":id_computer", $_POST["computer"]);
         $date_loan = (new \DateTime())->format("Y-m-d H:i:s");
         $addLoan->bindParam(":date_loan", $date_loan);
         $addLoan->bindParam(":state", $_POST["state"]);
         $comment = htmlspecialchars($_POST["comment"]);
         $addLoan->bindParam(":comment", $comment);
         $addLoan->execute();
         header("Location: {$this->router->generate("loan")}?info=success");
      }
   }

   public function loanDetails_form(int $id) {
      if(isset($_POST["submit"])) {
         $updateLoan = $this->db->prepare("UPDATE Loan SET date_restitution = :date_restitution WHERE id = :id");
         $date_restitution = (new \DateTime())->format("Y-m-d H:i:s");
         $updateLoan->bindParam(":date_restitution", $date_restitution);
         $updateLoan->bindParam(":id", $id);
         $updateLoan->execute();
      } elseif(isset($_POST["update"])) {
         $updateLoan = $this->db->prepare("UPDATE Loan SET date_restitution = :date_restitution,  id_user = :id_user, id_computer = :id_computer, state = :state, date_loan = :date_loan, comment = :comment WHERE id = :id");
         if(isset($_POST["date_end"])) {
            $updateLoan->bindParam(":date_restitution", $_POST["date_end"]);
         } else {
            $null_date = null;
            $updateLoan->bindParam(":date_restitution", $null_date);
         }
         $updateLoan->bindParam(":id_user", $_POST["customer"]);
         $updateLoan->bindParam(":id_computer", $_POST["computer"]);
         $updateLoan->bindParam(":state", $_POST["state"]);
         $updateLoan->bindParam(":date_loan", $_POST["date_start"]);
         $updateLoan->bindParam(":comment", $_POST["comment"]);
         $updateLoan->bindParam(":id", $id);
         $updateLoan->execute();
      }
      header("Location: {$this->router->generate("historic")}");
   }
}