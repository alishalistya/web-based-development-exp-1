<!DOCTYPE html>
<html lang="en">

<head>
    <title>Actor List Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/actor.css">
</head>
<body>
<?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
        <div class="actor-list-header">
            <h1>List of Actors</h1>
            <!-- if user = admin maka ada button add new -->
        </div>
        <div class="actor-container">
            <?php foreach ($this->data['actor'] as $index => $actor) : ?>
                <? extract(["actor" => $actor]);
                include(dirname(__DIR__) . '/actor/ActorComponent.php');
                ?>
            <?php endforeach; ?>
        </div>
</body>
</html>