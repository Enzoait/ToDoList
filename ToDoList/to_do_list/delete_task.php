<?php
    $mysqli = mysqli_connect("localhost", "root", "root", "to_do_list");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma To Do List</title>
</head>
<body>

<?php

    $hasSuccessfullyDeleted = mysqli_query($mysqli,"DELETE FROM todolist WHERE id = '{$_GET['id']}'");

    if($hasSuccessfullyDeleted) {
        header("Location: http://localhost/ToDoList");
    }


?>