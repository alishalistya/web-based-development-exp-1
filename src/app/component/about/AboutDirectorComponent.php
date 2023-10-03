<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actor</title>
    <link rel="stylesheet" href="../../../public/styles/about/aboutDirector.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/others/Navbar.css">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <div id="director-container">
        <img id="director-background" src="../../../public/img/Ana de Armas.jpg" alt="<?= $this->data['directorName'] ?>">
        <h2 id="about-director">
            about director,
        </h2>
        <img id="director-img" src="../../../public/img/Ana de Armas II.jpg" alt="<?= $this->data['directorName'] ?>">
        <h1 id="director-name">
            <?= $this->data['directorName'] ?>
        </h1>
        <h2 id="director-birth">
            <?= $this->data['directorBirth'] ?>
        </h2>
        <p id="director-description">
            <?= $this->data['directorDescription'] ?>
        </p>
    </div>
    
    <div class="director-movie-container">
        <h1 id="known-for">
            KNOWN FOR:
        </h1>
        <div class="row">
            <?php $count = 0; ?>
            <?php foreach ($this->data['images'] as $movieName => $imagePath): ?>
                <div class="picture">
                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $movieName; ?>">
                </div>
                <?php $count++; ?>
                <?php if ($count % 3 === 0): ?>
                    </div>
                    <?php if ($count < count($this->data['images'])): ?>
                        <div class="row"> 
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    
</body>
</html>