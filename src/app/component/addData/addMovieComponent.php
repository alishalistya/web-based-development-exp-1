<form action = "insert" method="post" class="addMovie" novalidate>
    <h1 class="auth-title">
        Tambahkan Film Baru
    </h1>
    <!-- Title -->
    <div class="form-group">
        <label for="title">Title</label>
        <input id="title" class="form-input" name="title" type="text" placeholder="Nama Film" />
        <i>
            <p id="title-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>
    <!-- Deskripsi -->
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <input id="description" class="form-input" name="description" type="text" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="description-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Release Date -->
    <div class="form-group">
        <label for="release-year">Release Year</label>
        <input id="year" class="form-input" name="release-year" type="text" placeholder="1996"/>
        <i>
            <p id="year-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Duration -->
    <div class="form-group">
        <label for="duration">Duration (minutes)</label>
        <input id="duration" class="form-input" name="duration" type="text" placeholder="230"/>
        <i>
            <p id="duration-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <div class="form-group">
        <label for="actors">Actor</label>
        <div class="select-actor">
            <select name="actors" id="actors">
                <?php foreach ($this->data["actors"] as $index => $actor) : ?>
                    <option value="<?= htmlspecialchars(json_encode(array('id' => $actor['actor_id'], 'name' => $actor['name']))) ?>" >
                        <?= $actor['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <i>
            <p id="actors-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
        <div class="selected-actor-container">
            <!-- <?php include(dirname(__DIR__) . '/others/TagComponent.php') ?> -->
        </div>
    </div>

    <div class="form-group">
        <label for="directors">Actor</label>
        <div class="select-director">
            <select name="directors" id="directors">
                <?php foreach ($this->data["directors"] as $index => $director) : ?>
                    <option value="<?= htmlspecialchars(json_encode(array('id' => $director['director_id'], 'name' => $director['name']))) ?>" >
                        <?= $director['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <i>
            <p id="directors-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
        <div class="selected-director-container">
            <!-- <?php include(dirname(__DIR__) . '/others/TagComponent.php') ?> -->
        </div>
    </div>

    <!-- Image -->
    <div class="form-group">
        <label for="movie_img">Poster Film</label>
        <input id="poster" class="form-input" name="movie_img" type="file" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="poster-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Trailer -->
    <div class="form-group">
        <label for="movie-trailer">Trailer</label>
        <input id="trailer" class="form-input" name="movie-trailer" type="file" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="trailer-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <button class="btn btn-primary">Submit</button>
</form>

<!-- <div class="register-btn">
    <a href="/auth/register" class="btn alt-btn">tombol lain</a>
</div> -->
