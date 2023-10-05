<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/review/review.css">
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <header class="review-header">
        <?php if (!$this->data['isAdmin']) : ?>
            <div class="title"><h1>Your Reviews</h1></div>
        <?php endif; ?>
    </header>
    <section class="review-section">                
        <div class="review-container">
            <?php foreach ($this->data['reviews'] as $index => $review) : ?>
                <? extract(["review" => $review]);
                include(dirname(__DIR__) . '/review/ReviewCardComponent.php');
                ?>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
