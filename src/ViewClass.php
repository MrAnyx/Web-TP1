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
      $stmt = $this->db->prepare("SELECT l.id, l.date_loan, l.date_restitution, c.last_name, c.first_name, o.brand, o.os FROM Loan as l INNER JOIN Customer as c ON l.id_user = c.id INNER JOIN Computer as o ON l.id_computer = o.id ORDER BY l.id DESC");
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
         $stmt = $this->db->prepare("SELECT l.id, l.date_loan, l.date_restitution, l.comment, c.last_name, c.first_name, o.brand, o.os, o.cpu, o.ram, l.state FROM Loan as l INNER JOIN Customer as c ON l.id_user = c.id INNER JOIN Computer as o ON l.id_computer = o.id WHERE l.id = :id");
         $stmt->bindParam(":id", $id);
         $stmt->execute();
         $loan = $stmt->fetch();

         require __DIR__ . "/../public/views/loanDetails.php";
      }
   }


}