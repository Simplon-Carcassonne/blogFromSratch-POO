<?php
/* => here */

class Database
{

    private $db; // private class's member (attribute, property, variable)

    // constants in class .. How to use it ? 
    // http://www.lephpfacile.com/manuel-php/language.oop5.constants.php
    const DB_NAME = 'simplonDatabase';
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const DB_TABLE = 'posts';

    public function __construct()
    {
        $this->connectbdd(); // store the connexion in $db
    }

    // private => can be called only here from THIS script !!
    private function connectbdd()
    {
        try {
            $this->db = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=utf8', self::DB_USER, self::DB_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">
                    ' . $e->getMessage() . '
                </div>';
            //die('Erreur : ' . $e->getMessage());
        }
    }

    // public $db's getter
    public function getDB()
    {
        return $this->db;
    }

    /***********************************************/
    /*                  POSTS CRUD                 */
    /***********************************************/
    //public or private here ? please ... put some details !
    function getAllPosts()
    {
        $sql = 'SELECT * FROM ' . self::DB_TABLE;
        $req = $this->db->query($sql);
        $result = $req->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function insertPost($title = "titre par défaut", $content = "contenu par défaut")
    {
        $sql = 'INSERT INTO ' . self::DB_TABLE . ' (title, content) VALUES (:title, :content)';
        $req = $this->db->prepare($sql);
        try {
            $result = $req->execute([
                'title' => $title,
                'content' => $content
            ]);
            return $result;
        } catch (PDOException $e) {
            return 'error: ' . $e->getMessage();
        }
    }

    /******** HERE ==> YOUR MISSION FOR TODAY ******/
    /***********************************************/
    function updatePost($idPost, $title = "titre MAJ par défaut", $content = "contenu MAJ par défaut")
    {
        $sql = 'YOUR SQL CODE'; //write your SQL code
        $req = $this->db->prepare($sql); //already prepared $req

        //execute the $req with parameters
        //keep try/catch for bot's validation
        try {
            $result = $req->execute([
                'YOUR PARAMETERS'
            ]);
            return 'OK';
        } catch (PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        } catch (ParseError $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }
    /******** HERE ==> YOUR MISSION FOR TODAY ******/
    /***********************************************/
    function getPost($idPost)
    {
        $sql = 'YOUR SQL CODE'; //write your SQL code
        $req = $this->db->prepare($sql); //already prepared $req

        //execute the $req with parameters
        //keep try/catch for bot's validation
        try {
            $result = $req->execute([
                'YOUR PARAMETERS'
            ]);
            //get the result

            //and return it !
            //return the post Object !!
        } catch (PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        } catch (ParseError $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }
    /******** HERE ==> YOUR MISSION FOR TODAY ******/
    /***********************************************/
    function deletePost($idPost)
    {
        $sql = 'YOUR SQL CODE'; //write your SQL code
        $req = $this->db->prepare($sql); //already prepared $req

        //execute the $req with parameters
        //keep try/catch for bot's validation
        try {
            $result = $req->execute([
                'YOUR PARAMETERS'
            ]);
            return 'OK';
        } catch (PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        } catch (ParseError $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }
}
