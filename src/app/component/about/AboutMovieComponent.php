<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actor</title>
    <link rel="stylesheet" href="../../../public/styles/about/aboutMovie.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/others/Navbar.css">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <div id="movie-container">
        <img id="movie-background" src="../../../public/img/Frozen.jpg" alt="<?= $this->data['movieTitle'] ?>">
        <h2 id="about-movie">
            about movie,
        </h2>
        <img id="movie-img" src="../../../public/img/Frozen.jpg" alt="<?= $this->data['movieTitle'] ?>">
        <video id="movie-trailer" controls>
            <source src="../../../public/img/Frozen.mp4" type="video/mp4">
        </video>
        <h1 id="movie-title">
            <?= $this->data['movieTitle'] ?>
        </h1>
        <h2 id="movie-year">
            <?= $this->data['movieYear'] ?>
        </h2>
        <h2 id="movie-director">
            <?= $this->data['movieDirector'] ?>
        </h2>
        <p id="movie-description">
            <?= $this->data['movieDescription'] ?>
        </p>
        <h2 id="cast">
            Cast:
        </h2>
        <ul class="movie-cast">
            <?php foreach ($this->data['movieCast'] as $actor): ?>
                <li ><?= $actor ?></li>
            <?php endforeach; ?>
        </ul>


    </div>
    
    <div id="review-container">
        <h2 id="review">
            Review
        </h2>
    </div>
    
</body>
</html>