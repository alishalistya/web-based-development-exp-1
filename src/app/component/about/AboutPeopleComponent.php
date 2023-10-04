<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About <?= $this->data['title']; ?></title>
    <link rel="stylesheet" href="../../../public/styles/about/aboutPeople.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/others/Navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <div id="people-container">
        <img id="people-background" src="../../../public/media/img/actor/Ana de Armas.jpg" alt="<?= $this->data['people']['name'] ?>">
        <h2 id="about-people" class="text">
            about <?= $this->data['title']; ?>,
        </h2>
        <img id="people-img" src="../../../public/media/img/actor/Ana de Armas II.jpg" alt="<?= $this->data['people']['name'] ?>">
        <h1 id="people-name" class="text">
            <?= $this->data['people']['name'] ?>
        </h1>
        <h2 id="people-birth" class="text">
            <?= $this->data['people']['birth_date'] ?>
        </h2>
        <p id="people-description" class="text">
            <?= $this->data['people']['description'] ?>
        </p>
    </div>
    
    <div class="people-movie-container">
        <h1 id="known-for" class="text">
            KNOWN FOR:
        </h1>
        <div class="row">
            <?php $count = 0; ?>
            <?php foreach ($this->data['images'] as $movieName => $imagePath): ?>
                <?php if ($count >= 6) break; ?>
                    <div class="picture">
                        <a href="movie">
                            <img src="<?php echo $imagePath; ?>" alt="<?php echo $movieName; ?>">
                        </a>
                    </div>
                    <?php $count++; ?>
            <?php endforeach; ?>
        </div>
    </div>
  
</body>
</html>