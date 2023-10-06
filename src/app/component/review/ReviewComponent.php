<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <link rel="stylesheet" type="text/css" href="/styles/review/review.css">    
    <script type="text/javascript" src="/js/review/delete-review.js" defer></script>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <header class="review-header">
        <?php if (!$this->data['isAdmin']) : ?>
            <div class="title"><h1>Your Reviews</h1></div>
        <?php else: ?>
            <div class="title"><h1>All Reviews</h1></div>
        <?php endif; ?>
    </header>
    <section class="review-section">                
        <div class="review-container">
            <?php foreach ($this->data['reviews'] as $index => $review) : ?>
                <!-- <div class="review-card-wrap"> -->
                <? extract(["review" => $review, "isAdmin" => $this->data['isAdmin']]);
                include(dirname(__DIR__) . '/review/ReviewCardComponent.php');
                ?>
                <!-- </div> -->
            <?php endforeach; ?>
        </div>
        <dialog class="modal">
            <?php include(dirname(__DIR__) . '/modal/DeleteReviewModal.php')?>
        </dialog>
    </section>
</body>
</html>
