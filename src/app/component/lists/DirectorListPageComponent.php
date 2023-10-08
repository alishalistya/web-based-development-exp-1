<!DOCTYPE html>
<html lang="en">

<head>
    <title>Director List Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/director.css">
    <link rel="stylesheet" type="text/css" href="/styles/lists/lists.css">
</head>
<body>
<?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <div class="list-container">
        <div class="list-header">
            <h1>List of Director</h1>
            <!-- if user = admin maka ada button add new -->
            <?php if ($this->data["isAdmin"]) : ?>
                <a href="/director/insert" class="btn btn-primary">Add New</a>
                <?php endif; ?>
        </div>
        <div class="director-container">
            <?php foreach ($this->data['director'] as $index => $director) : ?>
                <? extract(["director" => $director]);
                include(dirname(__DIR__) . '/director/DirectorComponent.php');
                ?>
            <?php endforeach; ?>
        </div>
    </div>
    
</body>
</html>