<div class="movie-card">
    <a href="/movie/detail/<?= $movie["movie_id"] ?>" class="movie-thumbnail">
        <img src="<?= STORAGE_URL ?>/img/movie/<?= $movie["img_path"] ?>.jpg" alt="<?= $movie["title"] ?>" />
    </a>
    <div class="movie-header">
        <h4 class="title"><?= $movie["title"] ?></p>
    </div>
</div>