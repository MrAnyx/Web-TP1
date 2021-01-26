# Web-TP1

## Pré-requis

- PHP <= 7.4
- composer
- MySQL / MariaDB

## Installation

1. Installation des packages
```bash
composer init
```

2. Créer la base de données

Executez le fichier `script.sql` dans votre base de données. 

2. Modifier les identifiants à la base de données

Rendez vous dans le fichier `/.env` à la racine du projet et modifiez les identifiants pour la base de données
 
> Si, dans certains cas, vous avez besoin d'avoir d'autres identifiants, vous pouvez les modifier individuellement dans le code.
>
>```php
>$dbConnection = new DBConnection(["db_port" => "33060"]);
>$db = $dbConnection->getDB();
> ```

3. Ajouter des valeurs dans la base de données

Executez la commande :
```bash
php includes/DataFixture/up.php
```
depuis la racine du projet.

Vous pouvez maintenant utilise le projet normalement depuis votre navigateur.

> Les identifiants des utilisateurs sont :
> - username : user0, user1, user2, ..., user19
> - password : password
