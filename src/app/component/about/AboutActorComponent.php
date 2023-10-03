<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actor</title>
    <link rel="stylesheet" href="../../../public/styles/about/aboutActor.css">
    <link rel="stylesheet" type="text/css" href="../../../public/styles/others/Navbar.css">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <div id="actor-container">
        <img id="actor-background" src="../../../public/img/Ana de Armas.jpg" alt="<?= $this->data['actorName'] ?>">
        <h2 id="about-actor">
            about actor,
        </h2>
        <img id="actor-img" src="../../../public/img/Ana de Armas II.jpg" alt="<?= $this->data['actorName'] ?>">
        <h1 id="actor-name">
            <?= $this->data['actorName'] ?>
        </h1>
        <h2 id="actor-birth">
            <?= $this->data['actorBirth'] ?>
        </h2>
        <p id="actor-description">
            <?= $this->data['actorDescription'] ?>
        </p>
    </div>
    
    <div class="actor-movie-container">
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


        <!-- <div class="row">
            <div class="picture">
                <img src="../../../public/img/Knives Out.jpg" alt="Picture 1">
            </div>
            <div class="picture">
                <img src="../../../public/img/Blade Runner.jpg" alt="Picture 2">
            </div>
        </div>
        <div class="row">
            <div class="picture">
                <img src="../../../public/img/Blonde.jpg" alt="Picture 3">
            </div>
            <div class="picture">
                <img src="../../../public/img/Ghosted.jpg" alt="Picture 4">
            </div>
        </div>
        <div class="row">
            <div class="picture">
                <img src="../../../public/img/Knock Knock.jpg" alt="Picture 5">
            </div>
            <div class="picture">
                <img src="../../../public/img/No Time To Die.jpg" alt="Picture 6">
            </div>
        </div> -->
    </div>
    
</body>
</html>