<?php

define('DB_NAME', 'simplonDatabase');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_TABLE', 'posts');

//More on globals variables ? See at => http://learningspot.altervista.org/php-variable-scope-and-file-inclusion/
//talking about => https://www.daniweb.com/programming/web-development/threads/291932/using-variables-from-an-included-file
$db; //global context for this variable

function connectbdd()
{
    try {
        global $db;
        //echo 'connect db';
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}


/***********************************************/
/*                  POSTS CRUD                 */
/***********************************************/
function getAllPosts()
{
    connectbdd();
    global $db;
    $sql = 'SELECT * FROM ' . DB_TABLE;
    //$db->query('SELECT titre, description FROM posts'); => don't want all ?
    $req = $db->query($sql);
    $result = $req->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function insertPost($title = "titre par défaut", $content = "contenu par défaut")
{
    connectbdd();
    global $db;
    $sql = 'INSERT INTO ' . DB_TABLE.' (title, content) VALUES (:title, :content)';
    $req = $db->prepare($sql);
    $req->execute([
        'title' => $title,
        'content' => $content
    ]);
}

/******** HERE ==> YOUR MISSION FOR TODAY ******/
/***********************************************/
function deletePost($idPost)
{
    connectbdd();
    global $db;

    //TODO : implement this function
    $sql = 'DELETE FROM ' . DB_TABLE.' WHERE id = :id';
    $req = $db->prepare($sql);
    $req->execute([
        'id' => $idPost
    ]);
}

/******** HERE ==> YOUR MISSION FOR TODAY ******/
/***********************************************/
function updatePost($idPost, $title = "titre MAJ par défaut", $content = "contenu MAJ par défaut")
{
    connectbdd();
    global $db;

    //TODO : implement this function
    $sql = 'UPDATE ' . DB_TABLE.' (id,title,content) SET(:id,:title,:content) WHERE id = :id';
    $req = $db->prepare($sql);
    $req->execute([
        'id' => $idPost,
        'title' => $title,
        'content' => $content
    ]);
}

/******** HERE ==> YOUR MISSION FOR TODAY ******/
/***********************************************/
function getPost($idPost)
{
    connectbdd();
    global $db;

    //TODO : implement this function
    $sql = 'SELECT * FROM ' . DB_TABLE.' WHERE id = :id';
    $req = $db->prepare($sql);
    $result = $req->execute([
        'id' => $idPost
    ]);

    $result = $req->fetchAll(PDO::FETCH_OBJ);
    return $result[0];
}
