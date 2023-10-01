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
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="debug">
        <div class="hasil-search"></div>
        <div class="hasil-sort"></div>
        <div class="hasil-filter"></div>
    </div>
</body>

</html>