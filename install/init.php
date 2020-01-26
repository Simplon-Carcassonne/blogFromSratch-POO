<?php

/***********************************************/
/* URL from root projet : /install/init.php    */
/***********************************************/

//active errors
error_reporting(-1);
ini_set('display_errors', 'On');

//require('../database.php'); //old way !!
require('../class/Database.php');
$database = new Database();

/********  Functions  **********/
function createDatabase()
{
    //connexion without database !
    try {
        $pdo = new PDO('mysql:host=' . Database::DB_HOST, Database::DB_USER, Database::DB_PASSWORD);
    } catch (Exception $e) {
        // error ? => die the script !!
        die('Erreur : ' . $e->getMessage());
    }
    $requete = "CREATE DATABASE IF NOT EXISTS `" . Database::DB_NAME . "` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

    $result = $pdo->prepare($requete)->execute();
    //var_dump($result);
}
function createPostsTable()
{
    //connexion WITH database specified 
    //No more needed => $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $requete = "CREATE TABLE IF NOT EXISTS `" . Database::DB_TABLE . "`(
        `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(30) NOT NULL,
        content VARCHAR(30) NOT NULL)";

    global $database; //needed here because of his global scope !! 

    // prepare and execute request
    $result = $database->getDB()->prepare($requete)->execute();
    //var_dump($result);

    //want to see Globals variables ??
    //var_dump($GLOBALS);
}

function insertExemplePosts()
{
    // Insert 4 random posts in database using the method insertPost in class/Database.php

    //params
    $postsNumber = 4; // insert 4 new posts only !
    $titles = array(
        "Mon premier titre",
        "Mon second titre",
        "Mon titre 3",
        "Mon titre 4",
    );
    $contents = array(
        "Mon premier contenu",
        "Mon second contenu",
        "Mon contenu 3",
        "Mon contenu 4",
    );
    global $database;

    //fill the table
    for ($i = 0; $i < $postsNumber; $i++) {
        echo $i . ' insert datas ' . $titles[$i];
        //insertPost(); // Too easy and not random
        //insertPost("un nouveau titre", "un nouveau contenu"); // 10 times the same thing ... need diversity
        //insertPost($titles[$i],$contents[$i]);// not bad, but all array's lengths must match the postNumber

        //with Random ... but values could exist twice in BDD
        $database->insertPost($titles[random_int(0, ($postsNumber - 1))], $contents[random_int(0, ($postsNumber - 1))]);
    }
}

/********* Actions working stuff  (if a button is clicked)  *******/
if (isset($_GET['action'])) {

    switch ($_GET['action']) {
        case 'database':
            echo '<div class="alert alert-success" role="alert">
                    click for databases ! 
                </div>';
            createDatabase();
            break;
        case 'postsTable':
            echo '<div class="alert alert-success" role="alert">
                    click for posts Table ! 
                </div>';
            createPostsTable();
            break;
        case 'insertPosts':
            echo '<div class="alert alert-success" role="alert">
                        click for insert exemple posts in Posts Table ! 
                    </div>';
            insertExemplePosts();
            break;
        default:
            echo '<div class="alert alert-warning" role="alert">
                    Action do not exist !!
                </div>';
            break;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Init project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Installation du projet</h1>
            <p class="lead">#BlogFromScratch mode POO - Projet RNCP Titre Développeur.se web et web mobile</p>
        </div>
    </div>
    <div class="container">
        <h2>Processus d'installation</h2>
        <div class="row">
            <div class="col-sm">
                <p>I. Créer la Base de données en local<br>
                    ATTENTION : adaptez les paramètres de connexion à la BDD dans fichier class/Database.php</p>
                <a href="?action=database" role="button" class="btn btn-outline-info">Create Database</a>
            </div>
            <div class="col-sm">
                <p>II. Créer la table <?php echo Database::DB_TABLE; ?></p>
                <a href="?action=postsTable" role="button" class="btn btn-outline-info">Create Table</a>
            </div>
            <div class="col-sm">
                <p>III. Importer des données exemples dans la table <?php echo Database::DB_TABLE; ?></p>
                <a href="?action=insertPosts" role="button" class="btn btn-outline-info">Insert Datas</a>
            </div>
        </div>
        <br><br>
        <h2>Rejoindre le projet</h2>
        <div class="row">
            <div class="col-sm">
                <a href="../" target="_blank" class="btn btn-outline-success" role="button">See Project</a>
            </div>

        </div>
    </div>
</body>

</html>