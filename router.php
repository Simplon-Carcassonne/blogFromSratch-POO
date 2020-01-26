<?php

/********* Actions working stuff  (if a button in index.php is clicked)  *******/
/*
    URL Formats : 
    ?action=deletePost&id=6
    ?action=createPost   post's params will be set by the fom when it will be submitted
*/
if (isset($_GET['action'])) {

    switch ($_GET['action']) {
        case 'deletePost':
            echo '<div class="alert alert-success" role="alert">
                    click for delete Post ! 
                </div>';
            deletePost($_GET['id']); // from Table => old way
            //TODO change for POO mode
            break;
        case 'udpatePost':
            echo '<div class="alert alert-warning" role="alert">
                    Function not yet implemented ! 
                </div>';
            // TODO
            break;
        case 'createPost':
            echo '<div class="alert alert-success" role="alert">
                        click for insert one new post in Posts Table ! 
                    </div>';
            //insertPost($_POST['titre'], $_POST['description']); // from Form => old way
            $result = $database->insertPost($_POST['titre'], $_POST['description']); // from Form
            echo '<div class="alert alert-danger" role="alert">
                    '.$result.'
                </div>';
            break;
        case 'seePost':
            echo '<div class="alert alert-success" role="alert">
                            click for insert one new post in Posts Table ! 
                        </div>';
            //NO => getPost($_POST['id']); // see in index.php
            break;
        case 'validateCode':
            echo '<div class="alert alert-success" role="alert">
                                click for controlScript ! 
                            </div>';
            // see in index.php for ValidationBot side !! (not for students)
            break;
        default:
            echo '<div class="alert alert-warning" role="alert">
                    Action do not exist !!
                </div>';
            break;
    }
}
