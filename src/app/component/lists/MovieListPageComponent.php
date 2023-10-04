<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie List Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/lists/lists.css">
</head>
<body>
<?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
        <div class="list-container">
            <div class="list-header">
                <h1> List of Movies </h1>
                <!-- if user = admin maka ada button add new -->
                <a href="/addData/movie" class="btn btn-primary">Add New</a>
            </div>
            <div class="movie-container">
                <?php foreach ($this->data['movies'] as $index => $movie) : ?>
                    <? extract(["movie" => $movie]);
                    include(dirname(__DIR__) . '/movie/MovieComponent.php');
                    ?>
                <?php endforeach; ?>
            </div>
        </div>
</body>
</html>