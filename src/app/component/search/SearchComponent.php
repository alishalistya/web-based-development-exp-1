<!DOCTYPE html>
<html lang="en">

<head>
    <title>Movie</title>
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/search/search.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/others/navbar.css">
    <script type="text/javascript" src="<?= BASE_URL ?>/js/search/search.js" defer></script>
</head>

<body>
    <?php include(dirname(__DIR__) . '/others/NavbarComponent.php')?>
    <section class="search-section">
        <div class="search-group">
            <div class="search search-box">
                <label for="search">Search</label>
                <input type="text" id="search" placeholder="Movie, Actor or Director" name="q">
            </div>
        <div class="search sort-box">
            <label for="sort">Sort By</label>
            <select name="sort" id="sort">
                <option value="1">Title (A-Z)</option>
                <option value="2">Title (Z-A)</option>
                <option value="3">Release Date (Newest)</option>
                <option value="4">Release Date (Oldest)</option>
            </select>
        </div>
        <div class="search cat-box">
            <label for="cat">Filter</label>
            <select name="cat" id="cat">
                <option value="">N/A</option>
                <?php foreach ($this->data["category"] as $index => $category) : ?>
                    <option value="<?= $category['name'] ?>">
                        <?= $category['name'] ?>
                        <?php endforeach; ?>
                    </option>
                </select>
            </div>
        </div>
    </section>
    <section class="result-section">
        <?php if (!$this->data['movies']) : ?>
            <div> NO RESULT</div>
        <?php else : ?>
            <div class="container">
                <?php foreach ($this->data['movies'] as $movie) :?>
                    <div class="name-movie"><?= $movie['title'] ?></div>
                    <div class="name-movie"><?= $movie['description'] ?></div>
                    <div class="name-movie"><?= $movie['release_date'] ?></div>
                    <div class="name-movie"><?= $movie['duration'] ?></div>
                    <br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    </body>

</html>