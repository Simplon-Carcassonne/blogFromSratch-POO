<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, user-scalable=no">
</head>

<body>

    <?php
    //require('database.php'); //include for getAllPosts method in database.php !!
    //database.php is replaced by POO Database system
    require('class/Database.php');
    $database = new Database();

    require('router.php'); //include for analyse Get params and calls to BDD
    $posts = $database->getAllPosts();
    //var_dump($posts); //uncomment only for debug , not in production !!
    ?>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Travail POO sur Table Posts</h1>
            <p class="lead">#POOFromScratch - Projet RNCP Titre Développeur.se web et web mobile</p>
        </div>
    </div>
    <div class="container">
        <?php if ($posts) : ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Contenu</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) : ?>
                        <tr>
                            <th scope="row"><?php echo $post->id; ?></th>
                            <td><?php echo $post->title; ?></td>
                            <td><?php echo $post->content; ?></td>
                            <td>Actions :

                                <a href="?action=deletePost&id=<?php echo $post->id; ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else :  //else {
        ?>
            <div class="alert alert-warning" role="alert">
                Pas encore de post en database !
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <hr>
        <div class="row">
            <div class="col col-4">
                <h2>Ajouter un post</h2>
                <div>
                    <form method="post" action="?action=createPost">
                        <div class="form-group">
                            <label>Titre de l'article</label>
                            <input type="text" class="form-control" value="<?php echo isset($_POST['titre']) ? $_POST['titre'] : 'valeur par défaut'; ?>" placeholder="Entrez un titre SVP" name="titre">
                        </div>
                        <div class="form-group">
                            <label>Description de l'article</label>
                            <input type="text" class="form-control" placeholder="Description" name="description">
                            <button type="submit" class="btn btn-primary mt-3" name="envoyer">Creer un article</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col col-4">
                <h2>"Voir" un post</h2>
                <div>
                    <form method="post" action="?action=seePost">
                        <div class="form-group">
                            <label>ID du Post</label>
                            <input type="text" class="form-control" placeholder="ID du post (cf tableau)" name="idPost">
                            <button type="submit" class="btn btn-primary mt-3" name="envoyer">Voir l'article</button>
                        </div>
                    </form>
                </div>
                <!--
                /************* HERE ==> YOUR MISSION FOR TODAY **********/
                /* Use the Database getPost method */
                /********************************************************/
                -->
                <div>
                    <h3>Contenu du post demandé </h3>
                    <?php
                    if (isset($_POST['idPost'])) {
                        $post = getPost($_POST['idPost']); //old way change for POO method (have to implement the method in Database's class)
                        //var_dump($post);  //uncoment to see the format of the query's result
                        if ($post) {
                            echo '<h5>Titre: ' . $post->title . '</h5>
                                <p>Contenu:' . $post->content . '</p><br><br>';
                        } else {
                            echo '<div class="alert alert-warning" role="alert">
                                        Pas encore de post avec cet ID en database !
                                    </div><br><br>';
                        }
                    } else {
                        echo '<div class="alert alert-warning" role="alert">
                                        Aucun ID de post demandé !
                                    </div><br><br>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>