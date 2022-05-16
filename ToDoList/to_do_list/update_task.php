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
<body>

<?php
    $result = mysqli_query($mysqli, "SELECT id, firstname, lastname FROM users");
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);


    $hasSuccessfullyUpdated = false;
    if (!empty($_POST)) {
        $descriptionn = substr($_POST['taskdesc'], 0, 50);

        $hasSuccessfullyUpdated = mysqli_query(
            $mysqli, 
            "UPDATE todolist 
            SET title = '{$_POST['title']}', 
                descriptionn = '$descriptionn',
                taskdesc = '{$_POST['taskdesc']}',
                author_id = '{$_POST['author_id']}'
            WHERE id = '{$_GET['id']}'"
        );
    }

    $result = mysqli_query(
        $mysqli,
        "SELECT title, taskdesc, author_id
        FROM todolist
        WHERE id = '{$_GET['id']}'"
    );

    $task = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

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


<h1>Modifier une tâche</h1>
<a href="../../" class="link-color">Retour à l'accueil</a>

<?php if ($hasSuccessfullyUpdated): ?>
    <div style="padding: 8px; border: 1px solid green; margin-top: 12px;">
        <p style="font-weight: bold; margin: 0; color: green;">Bravo !</p>
        <p style="margin: 0; color: green;">Votre tache à été mise à jour</p>
    </div>
<?php endif; ?>

<form method="POST">
    <div>
        <label>
            <p>Titre de la tâche</p>
            <input type="text" name="title" value="<?= $task['title'] ?>">
        </label>
    </div>
    <div>
        <label>
            <p>Description de la tache de la tâche</p>
            <textarea name="taskdesc" rows="20" cols="50"><?= $task['taskdesc'] ?></textarea>
        </label>
    </div>
    <div>
        <select name="author_id">
            <?php foreach ($users as $author): ?>
                <option <?= $task['author_id'] === $author['id'] ? 'selected' : '' ?> value="<?= $author['id'] ?>"><?= $author['firstname'].' '.$author['lastname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <br>
        <input type="radio" name="ch[]" value="tache_non_validee" <?php if (in_array("tache_non_validee", $ch)) echo "checked" ?>>Tache non validée
        <br>
        <input type="radio" name="ch[]" value="tache_validee" <?php if (in_array("tache_validee", $ch)) echo "checked" ?>>Tache validée
        <br>
    </div>
    

    <button style="margin-top: 24px" name="valider">Sauvegarder la tâche</button>
</form>


</body>
</html>