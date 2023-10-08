<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie List Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/lists/lists.css">
    <!-- <link rel="stylesheet" type="text/css" href="/styles/movie/movie.css"> -->

    <script type="text/javascript" src="/js/others/pagination.js" defer></script>

</head>
<body>
<?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
        <div class="list-container">
            <div class="list-header">
                <h1> List of Movies </h1>
                <!-- if user = admin maka ada button add new -->
                <a href="/movie/insert" class="btn btn-primary">Add New</a>
            </div>
            <div class="movie-container">
            </div>
            <?php include(dirname(__DIR__) . '/others/PaginationGroup.php') ?>
        </div>
</body>
</html>