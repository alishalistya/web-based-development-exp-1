<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Movie</title>
    <link rel="stylesheet" href="../../../public/styles/about/aboutMovie.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/others/Navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <div id="movie-container">
        <img id="movie-background" src="../../../public/media/img/movie/<?= $this->data['movie']['img_path'] ?>.jpg" alt="<?= $this->data['movie']['title'] ?>">
        <h2 id="about-movie" class="text">
            about Movie,
        </h2>
        <img id="movie-img" src="../../../public/media/img/movie/<?= $this->data['movie']['img_path'] ?>.jpg" alt="<?= $this->data['movie']['title'] ?>">
        <video id="movie-trailer" controls>
            <source src="../../../public/media/img/trailer/<?= $this->data['movie']['trailer_path'] ?>.mp4" type="video/mp4">
        </video>
        <h1 id="movie-title" class="text">
            <?= $this->data['movie']['title'] ?>
        </h1>
        <p id="movie-release" class="text">
                <?= $this->data['movie']['release_date'] ?>
        </p>
        <p id="movie-duration" class="text">
                <?= $this->data['movie']['duration'] ?>
        </p>
        <h2 id="movie-director" class="text">
            <?= $this->data['director']['name'] ?>
        </h2>
        <div class="movie-cast text">
            <?php foreach ($this->data['actor'] as $key => $actor): ?>
                <span><?= $actor['name'] ?></span>
                <?php if ($key !== array_key_last($this->data['actor'])): ?>
                    <span> | </span>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
        <p id="movie-description" class="text">
            <?= $this->data['movie']['description'] ?>
        </p>


    </div>
    
    <div id="review-container">
        <h2 id="review" class="text">
            REVIEW:
        </h2>
        <div class="row">
            <?php $count = 0; ?>
            <?php foreach ($this->data['reviews'] as $review): ?>
                <?php if ($count >= 10) break; ?>
                    <div class="review-card text">
                        <p> <?= $review ?> </p>
                    </div>
                    <?php $count++; ?>
            <?php endforeach; ?>
        </div>
        <h3 id="review-end" class="text">
            Reviews from MOI.
        </h3>
        <h4 id="review-end2" class="text">
            Reviews from MOI.
        </h4>
    </div>
    
</body>
</html>