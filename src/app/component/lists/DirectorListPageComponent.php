<!DOCTYPE html>
<html lang="en">

<head>
    <title>Director List Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/director.css">
</head>
<body>
<?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
        <div class="director-list-header">
            <h1>List of Director</h1>
            <!-- if user = admin maka ada button add new -->
        </div>
        <div class="director-container">
            <?php foreach ($this->data['director'] as $index => $director) : ?>
                <? extract(["director" => $director]);
                include(dirname(__DIR__) . '/director/DirectorComponent.php');
                ?>
            <?php endforeach; ?>
        </div>
</body>
</html>