<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
</head>

<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <article> 
        <?php if (!$this->data['film_arr']): ?>
            <p class="info"> There are no films for you. </p>
        <?php endif; ?>

        <div class= "film-container">
            <?php foreach ($this->data['film_arr'] as $index => $film) : ?>
                <a href="/public/film/detail/<?= $film->film_id ?>" class="single-film">
                    <div class="top-section">
                        <img src="<?= STORAGE_URL ?>/images/<?= $film->image_path ?>" alt="<?= $film->judul ?>">
                        <header class="film-header">
                            <p class="title"><?= $film->judul ?></p>
                            <p><?= $film->penyanyi ?></p>
                        </header>
                    </div>
                    <!-- harusnya judul dan  -->
                </a>
            <?php endforeach; ?>
        </div>
    </article>
</body>

</html>