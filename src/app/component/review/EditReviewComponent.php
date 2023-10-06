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
    <?php 
        $movie = $this->data['movie'];
        $action = $this->data['action'];
    ?>
</head>
<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <section class="edit-section">                
        <div class="movie-container">
            
        </div>
        <div class="form-container">
            <form class="edit-form" data="<?= $movie_id ?>">
                <header class="form-header">
                    <h1 class="form-title">
                        <?php if($action === 'add') : ?>
                            Edit Review
                        <?php else : ?>
                            Add Review
                        <?php endif; ?>
                    </h1>
                </header>
                <div class="form-group">
                    <label for="rate">Description</label>
                    <input class="form" name="rate" type="number" placeholder="1" min="1" max="10" value="5"/>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input class="form-input" name="description" type="text" placeholder="Sebuah Deskripsi" value="ini valu yang suddah ada"/>
                </div>
            </form>
        </div>
        <dialog class="modal">
            <?php include(dirname(__DIR__) . '/modal/DeleteReviewModal.php')?>
        </dialog>
    </section>
</body>
</html>
