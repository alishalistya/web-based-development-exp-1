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
        <img id="people-background" src="../../../public/media/img/actor/<?= $this->data['people']['img_path'] ?>.jpeg" alt="<?= $this->data['people']['img_path'] ?>">
        <h2 id="about-people" class="text">
            about <?= $this->data['title']; ?>,
        </h2>
        <img id="people-img" src="../../../public/media/img/actor/<?= $this->data['people']['img_path'] ?>.jpeg" alt="<?= $this->data['people']['img_path'] ?>">
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
            <?php foreach ($this->data['movie'] as $movie): ?>
                <?php if ($count >= 6) break; ?>
                    <div class="picture">
                        <a href="movie?title=<?= $movie['title'] ?>">
                            <img src="../../../public/media/img/movie/<?= $movie['img_path']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
                        </a>
                    </div>
                    <?php $count++; ?>
            <?php endforeach; ?>
        </div>
        <!-- page navigation -->
        <div class="page-navigation">
            <div class="page">
                <?php if ($this->data['page'] > 1): ?>
                    <a href="actor?name=<?= $this->data['people']['name'] ?>&page=<?= $this->data['page'] - 1 ?>">
                        <span class="material-icons">
                            <
                        </span>
                    </a>
                <?php endif; ?>
                <span class="page-number">
                    <?= $this->data['page'] ?>
                </span>
                <?php if ($this->data['page'] < $this->data['totalPage']): ?>
                    <a href="actor?name=<?= $this->data['people']['name'] ?>&page=<?= $this->data['page'] + 1 ?>">
                        <span class="material-icons">
                            >
                        </span>
                    </a>
                <?php endif; ?>
            </div>
    </div>
  
</body>
</html>