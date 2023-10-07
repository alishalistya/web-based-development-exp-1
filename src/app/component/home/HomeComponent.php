<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/movie.css">
    <link rel="stylesheet" type="text/css" href="/styles/home/home.css">
</head>

<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php') ?>
    <?php if (!$this->data['movies']) : ?>
        <p class="info"> There are no movies for you. </p>
    <?php endif; ?>
    <div class="home-container">
        <header class="home-header">
            <img src="/media/images/anatomy-header.png" alt="Header movie"/>
            <div class="header-desc">
                <h3>Anatomy of a Fall (2023)</h3>
                <p>Directed by Justine Triet</p>
            </div>
        </header>
        <div class="home-recommend-header">
            <h1>Top Movies For You</h1>
            <div class="header-buttons">
                <a href="movie/catalog/1" class="btn btn-primary">View Films</a>
                <a href="director/catalog" class="btn btn-primary">View Directors</a>
                <a href="actor/catalog" class="btn btn-primary">View Actors</a>
            </div>
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