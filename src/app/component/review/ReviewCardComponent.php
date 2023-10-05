<div class="review-card">
    <a class="review-detail" href="<?= $review['movie_id'] ?>">
        <div class="review-img">
            <img src="<?= STORAGE_URL ?>/img/movie/<?= $review['img_path'] ?>.jfif" alt="<?= $review["img_path"] ?>" />
        </div>
        <div class="review-info">
            <div class="review-title">
                <h2 class="movie-title"><?= $review['title'] ?></h2>
                <h1>
                    <span id="rate-text">(<span class="movie-rate"><?= $review['rate'] ?></span>/10)</span>
                </h1>
            </div>
            <div class="movie-desc-box">
                <div class="movie-desc-text">
                    <p><?= $review['comment'] ?></p>
                </div>
            </div>
            <div class="review-date">
                <p class="create-text">Created : (<?= $review['created_at'] ?>)</p>
                <p class="create-text">Updated : (<?= $review['update_at'] ?>)</p>
            </div>
        </div>
    </a>
    <div class="review-panel">
        <button id="edit-btn" class="btn">Edit</button>
        <button id="delete-btn"class="btn">Delete</button>
    </div>
</div>