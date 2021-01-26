<?php

use Ramsey\Uuid\Uuid;
use Faker\Factory;
use App\DB\DBConnection;

require_once __DIR__ . "/../../vendor/autoload.php";

$faker = Factory::create();
$dbConnection = new DBConnection(["db_port" => "33060"]);
$db = $dbConnection->getDB();

$addCustomer = $db->prepare("INSERT INTO Customer(nom, prenom, coord, classe) VALUES (:nom, :prenom, :coord, :classe)");
$addCustomer->bindParam(":nom", $nom);
$addCustomer->bindParam(":prenom", $prenom);
$addCustomer->bindParam(":coord", $coord);
$addCustomer->bindParam(":classe", $classe);

$addComputer = $db->prepare("INSERT INTO Computer(serial, brand, os, cpu, ram) VALUES (:serial, :brand, :os, :cpu, :ram)");
$addComputer->bindParam(":serial", $serial);
$addComputer->bindParam(":brand", $brand);
$addComputer->bindParam(":os", $os);
$addComputer->bindParam(":cpu", $cpu);
$addComputer->bindParam(":ram", $ram);

$addUser = $db->prepare("INSERT INTO User(username, password) VALUES (:username, :password)");
$addUser->bindParam(":username", $username);
$addUser->bindParam(":password", $password);

$classeList = ["6em4", "5em3", "4em5", "3em1", "6em2", "5em2", "4em3", "3em3"];
$brandList = ["Acer", "Asus", "Apple", "MSI", "Lenovo"];
$osList = ["Windows", "MacOS"];
$cpuList = ["intel", "amd"];
$ramList = ["4Go", "6Go", "8Go", "32Go"];
$userIds = [];
$computerIds = [];

for($i = 0; $i<50; $i++) {
   $serial = Uuid::uuid4()->toString();
   $brand = $faker->randomElement($brandList);
   $os = $faker->randomElement($osList);
   $cpu = $faker->randomElement($cpuList);
   $ram = $faker->randomElement($ramList);
   $addComputer->execute();
   $computerIds[] = $db->lastInsertId();
}

for($i = 0; $i<50; $i++) {
   $nom = $faker->firstName;
   $prenom = $faker->lastName;
   $coord = $faker->address;
   $classe = $faker->randomElement($classeList);
   $addCustomer->execute();
   $userIds[] = $db->lastInsertId();
}

for($i = 0; $i < 20; $i++) {
   $username = "user$i";
   $password = password_hash("password", PASSWORD_ARGON2I);
   $addUser->execute();
}