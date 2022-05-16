<?php
    $mysqli = mysqli_connect("localhost", "root", "root", "to_do_list");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Ma To Do List</title>
</head>
<body class="background">

<?php 
    @$ch=$_POST['ch'];
    @$valider=$_POST['valider'];
    if (isset($valider)){
        if (is_null($ch)){
            $ch[0]="tache_non_validee";
        }
    }
    if (is_null($ch)){
        $ch[0]="tache_non_validee";
    }
    echo "Votre tache à été mise a jour à l'état suivant :  <br />";
    echo @implode("-", $ch);
    echo "<hr />";
 ?>


<?php
    ini_set('display_errors', 1);

    $id = $_GET['id'];

    $result = mysqli_query(
        $mysqli,
        "SELECT
            title, 
            taskdesc, 
            published_at, 
            users.firstname AS author_firstname, 
            users.lastname AS author_lastname
        FROM 
            todolist
        INNER JOIN users ON todolist.author_id = users.id
        WHERE
            todolist.id = '{$_GET["id"]}'"
    );

    $task = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<article>
    <a href="../" class="link-color">Retour à l'accueil</a>
    <h2 class="text-color-2"><?= $task['title'] ?></h2>
    <p class="text-color-2"><?= nl2br($task['taskdesc']) ?></p>
    <p class="text-color-2">Assigné à <?= $task['author_firstname']. ' ' . $task['author_lastname'] ?></p>
    <p class="text-color-2">Crée le
    <time datetime="<?= $task['published_at'] ?>">
        
        <?= date("d/m/o \à H\:i", strtotime($task['published_at'])) ?>
    </time></p>
    <form method="POST">
    <section class="text-color-2">
    <input type="radio" name="ch[]" value="tache_non_validee" <?php if (in_array("tache_non_validee", $ch)) echo "checked" ?>>Tache non validée
    <br>
    <input type="radio" name="ch[]" value="tache_validee" <?php if (in_array("tache_validee", $ch)) echo "checked" ?>>Tache validée
    <br>
    <input type="submit" name="valider" value="Envoyer">
    </section>
    </form>
</article>

</body>
</html>