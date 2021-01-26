<?php

namespace App\DB;

use PDO;

class DBConnection {

   /**
    * @var PDO
    */
   private PDO $db;

   /**
    * DBConnection constructor.
    * @param string $db_host
    * @param string $db_pass
    * @param string $db_user
    * @param string $db_name
    * @param string $db_port
    */
   public function __construct(string $db_host, string $db_pass, string $db_user, string $db_name, string $db_port) {
      $this->db = new PDO("mysql:host={$db_host}:{$db_port};dbname={$db_name}", $db_user, $db_pass, [
         PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
   }

   /**
    * @return PDO
    */
   public function getDB(): PDO
   {
      return $this->db;
   }
}