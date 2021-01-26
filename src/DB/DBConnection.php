<?php

namespace App\DB;

use PDO;
use Symfony\Component\Dotenv\Dotenv;

class DBConnection {

   /**
    * @var PDO
    */
   private PDO $db;

   /**
    * DBConnection constructor.
    * @param array $params
    */
   public function __construct(array $params = []) {
      $dotenv = new Dotenv();
      $dotenv->load(__DIR__.'/../../.env');
      $db_host = array_key_exists("db_host", $params) ? $params["db_host"] : $_ENV["DB_HOST"];
      $db_port = array_key_exists("db_port", $params) ? $params["db_port"] : $_ENV["DB_PORT"];
      $db_user = array_key_exists("db_user", $params) ? $params["db_user"] : $_ENV["DB_USER"];
      $db_pass = array_key_exists("db_pass", $params) ? $params["db_pass"] : $_ENV["DB_PASS"];
      $db_name = array_key_exists("db_name", $params) ? $params["db_name"] : $_ENV["DB_NAME"];
      $this->db = new PDO("mysql:host=" . $db_host . ":" . $db_port . ";dbname=" . $db_name, $db_user, $db_pass, [
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