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
    $result = mysqli_query($mysqli, "SELECT id, firstname, lastname FROM users");
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $hasSuccessfullyInserted = false;
    if (!empty($_POST)) {
        $descriptionn = substr($_POST['taskdesc'], 0, 50);

        $hasSuccessfullyInserted = mysqli_query(
            $mysqli, 
            "INSERT INTO todolist (title, descriptionn, taskdesc, author_id) 
            VALUES ('{$_POST['title']}', '$descriptionn', '{$_POST['taskdesc']}', '{$_POST['author_id']}')
        ");
    }
?>
<h1 class="text-color">Créer une nouvelle tâche</h1>
<a href="../" class="link-color">Retour à l'accueil</a>

<?php if ($hasSuccessfullyInserted): ?>
    <div style="padding: 8px; border: 1px solid green; margin-top: 12px;">
        <p style="font-weight: bold; margin: 0; color: green;">Bravo !</p>
        <p style="margin: 0; color: green;">Votre nouvelle tâche a été sauvegardée</p>
    </div>
<?php endif; ?>

<form method="POST">
    <div class="text-color-2">
        <label>
            <p>Titre de la tâche</p>
            <input type="text" name="title">
        </label>
    </div>
    <div class="text-color-2">
        <label>
            <p>Description de la tâche</p>
            <textarea name="taskdesc" rows="20" cols="50" ></textarea>
        </label>
    </div>
    <div class="text-color-2">
        <select name="author_id">
            <?php foreach ($users as $author): ?>
                <option value="<?= $author['id'] ?>"><?= $author['firstname'].' '.$author['lastname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="text-color-2">
    <button style="margin-top: 24px">Sauvegarder la tâche</button>
    </div>
</form>

</body>
</html>