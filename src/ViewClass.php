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

   public function accueil() {
      require __DIR__ . "/../public/views/accueil.php";
   }

   public function login()
   {
      if(isset($_SESSION["user"])) {
         header("Location: {$this->router->generate("accueil")}");
      } else {
         require __DIR__ . "/../public/views/login.php";
      }
   }

   public function historique() {
      $stmt = $this->db->prepare("SELECT e.id, e.date_emprunt, e.date_restitution, c.nom, c.prenom, o.brand, o.os FROM Emprunt as e INNER JOIN Customer as c ON e.id_user = c.id INNER JOIN Computer as o ON e.id_computer = o.id ORDER BY e.id DESC");
      $stmt->execute();
      $emprunts = $stmt->fetchAll();
      require __DIR__ . "/../public/views/historique.php";
   }

   public function emprunt() {
      if(!isset($_SESSION["user"])) {
         header("Location: {$this->router->generate("accueil")}");
      }else {
         $stmt = $this->db->prepare("SELECT id, nom, prenom FROM Customer ORDER BY nom");
         $stmt->execute();
         $customers = $stmt->fetchAll();

         $stmt = $this->db->prepare("SELECT id, brand, os, cpu, ram FROM Computer ORDER BY brand ASC");
         $stmt->execute();
         $computers = $stmt->fetchAll();

         require __DIR__ . "/../public/views/emprunt.php";
      }
   }

   public function logout() {
      session_unset();
      session_destroy();
      header("Location: {$this->router->generate("accueil")}");
   }

   public function empruntDetails(int $id) {
      if(!isset($_SESSION["user"])) {
         header("Location: {$this->router->generate("accueil")}");
      }else {
         $stmt = $this->db->prepare("SELECT e.id, e.date_emprunt, e.date_restitution, e.commentaire, c.nom, c.prenom, o.brand, o.os, o.cpu, o.ram, e.etat FROM Emprunt as e INNER JOIN Customer as c ON e.id_user = c.id INNER JOIN Computer as o ON e.id_computer = o.id WHERE e.id = :id");
         $stmt->bindParam(":id", $id);
         $stmt->execute();
         $emprunt = $stmt->fetch();

         require __DIR__ . "/../public/views/empruntDetails.php";
      }
   }


}