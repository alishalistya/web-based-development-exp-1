<form method="post" class="addMovie" novalidate>
    <h1 class="auth-title">
        Tambahkan Film Baru
    </h1>
    <!-- Title -->
    <div class="form-group">
        <label for="title">Title</label>
        <input class="form-input" name="title" type="text" placeholder="Nama Film" />
    </div>
    <!-- Deskripsi -->
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <input class="form-input" name="description" type="text" placeholder="Sebuah Deskripsi"/>
    </div>

    <!-- Release Date -->
    <div class="form-group">
        <label for="release-date">Release Year</label>
        <input class="form-input" name="release-date" type="text" placeholder="1996"/>
    </div>

    <!-- Duration -->
    <div class="form-group">
        <label for="duration">Duration (minutes)</label>
        <input class="form-input" name="duration" type="text" placeholder="230"/>
    </div>

    <!-- Image -->
    <div class="form-group">
        <label for="description">Poster Film</label>
        <input class="form-input" name="description" type="file" placeholder="Sebuah Deskripsi"/>
    </div>

    <!-- Trailer -->
    <div class="form-group">
        <label for="description">Trailer</label>
        <input class="form-input" name="description" type="file" placeholder="Sebuah Deskripsi"/>
    </div>

    <button class="btn btn-primary">Submit</button>
</form>

<!-- <div class="register-btn">
    <a href="/auth/register" class="btn alt-btn">tombol lain</a>
</div> -->
