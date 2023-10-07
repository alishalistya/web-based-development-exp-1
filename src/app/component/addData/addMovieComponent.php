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
