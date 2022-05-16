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
    $result = mysqli_query(
        $mysqli, 
        'SELECT 
            todolist.id, 
            title, 
            descriptionn, 
            published_at,
            users.firstname AS author_firstname, 
            users.lastname AS author_lastname
        FROM 
            todolist 
        INNER JOIN users ON todolist.author_id = users.id'
    );

    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<section >
    <h1 class="text-color">Ma To Do List</h1>
    <a href="to_do_list/create_task.php" class="link-color">Créer une nouvelle tâche</a>
</section>



<form method="POST">
<section>
    <?php foreach($tasks as $task): ?>
        <a href="/ToDoList/to_do_list/task.php?id=<?= $task['id'] ?>" style="color: black; text-decoration: none;">
            <article>
                <h2 class="text-color"><?= $task['title'] ?></h2>
                <p class="text-color-2"><?= $task['descriptionn'] ?></p>
                <p class="text-color-2">Assigné à : <?= $task['author_firstname']. ' ' . $task['author_lastname'] ?></p>
                <p class="text-color-2">Publié le 
                <time datetime="<?= $task['published_at'] ?>">
                    
                    <?= date("d/m/o \à H\:i", strtotime($task['published_at'])) ?>
                </time></p>
                <div class="col-2">
                    <a href="to_do_list/update_task.php/?id=<?= $task['id'] ?>" class="link-color">Modifier la tâche</a>
                    <a href="to_do_list/delete_task.php/?id=<?= $task['id'] ?>" class="link-color">Suprimer la tâche</a>
                </div>
            </article>
        </a>
    <?php endforeach ?>
</section>
</form>

</body>
</html>