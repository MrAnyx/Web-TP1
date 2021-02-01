<?php


namespace App;


use AltoRouter;
use App\DB\DBConnection;
use PDO;

class ViewClass
{
   /**
    * @var AltoRouter
    */
   private AltoRouter $router;

   /**
    * @var PDO
    */
   private PDO $db;


   /**
    * ViewClass constructor.
    * @param AltoRouter $router
    */
   public function __construct(AltoRouter $router)
   {
      $this->router = $router;
      $dbConnection = new DBConnection();
      $this->db = $dbConnection->getDB();
   }

   public function home() {
      require __DIR__ . "/../public/views/home.php";
   }

   public function login()
   {
      if(isset($_SESSION["user"])) {
         header("Location: {$this->router->generate("home")}");
      } else {
         require __DIR__ . "/../public/views/login.php";
      }
   }

   public function historic() {
      $sql = "SELECT l.id, l.date_loan, l.date_restitution, c.last_name, c.first_name, o.brand, o.os FROM Loan as l INNER JOIN Customer as c ON l.id_user = c.id INNER JOIN Computer as o ON l.id_computer = o.id";
      $whereOption = "";
      if(isset($_GET["value"]) && isset($_GET["option"]) && isset($_GET["submit"])) {
         if($_GET["submit"] === "search") {
            switch($_GET["option"]) {
               case "start_date":
                  $whereOption = "l.date_loan";
                  break;
               case "end_date":
                  $whereOption = "l.date_restitution";
                  break;
               case "last_name":
                  $whereOption = "c.last_name";
                  break;
               case "first_name":
                  $whereOption = "c.first_name";
                  break;
               case "computer":
                  $whereOption = "CONCAT(o.brand, ' - ', o.os)";
                  break;
            }
            $sql .= " WHERE $whereOption LIKE :value ";
         } elseif($_GET["submit"] === "reset") {
             header("Location: {$this->router->generate("historic")}");
         }
      }

      $sql .= " ORDER BY l.id DESC";
      $stmt = $this->db->prepare($sql);

      if(isset($_GET["value"]) && isset($_GET["option"]) && isset($_GET["submit"]) && $_GET["submit"] === "search") {
         $value = "%{$_GET['value']}%";
         $stmt->bindParam("value", $value);
      }
      $stmt->execute();
      $loans = $stmt->fetchAll();
      require __DIR__ . "/../public/views/historic.php";
   }

   public function loan() {
      if(!isset($_SESSION["user"])) {
         header("Location: {$this->router->generate("home")}");
      }else {
         $stmt = $this->db->prepare("SELECT id, last_name, first_name FROM Customer ORDER BY last_name");
         $stmt->execute();
         $customers = $stmt->fetchAll();

         $stmt = $this->db->prepare("SELECT id, brand, os, cpu, ram FROM Computer ORDER BY brand ASC");
         $stmt->execute();
         $computers = $stmt->fetchAll();

         require __DIR__ . "/../public/views/loan.php";
      }
   }

   public function logout() {
      session_unset();
      session_destroy();
      header("Location: {$this->router->generate("home")}");
   }

   public function loanDetails(int $id) {
      if(!isset($_SESSION["user"])) {
         header("Location: {$this->router->generate("home")}");
      }else {
         $stmt = $this->db->prepare("SELECT * FROM Loan WHERE id = :id");
         $stmt->bindParam(":id", $id);
         $stmt->execute();
         $loan = $stmt->fetch();

         $stmt = $this->db->prepare("SELECT id, last_name, first_name FROM Customer ORDER BY last_name");
         $stmt->execute();
         $customers = $stmt->fetchAll();

         $stmt = $this->db->prepare("SELECT id, brand, os, cpu, ram FROM Computer ORDER BY brand ASC");
         $stmt->execute();
         $computers = $stmt->fetchAll();

         require __DIR__ . "/../public/views/loanDetails.php";
      }
   }


}