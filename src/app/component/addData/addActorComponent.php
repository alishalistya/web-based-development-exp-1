<form action="insert" method="post" class="addPeople" enctype="multipart/form-data" novalidate>
    <h1 class="auth-title">
        Tambahkan Actor Baru
    </h1>

   <!-- Name -->
   <div class="form-group">
        <label for="name">Name</label>
        <input id="name" class="form-input" name="name" type="text" placeholder="Nama Director" />
        <i>
            <p id="name-warn" class="hide alert-text">Nggak boleh kosong!</p>
        </i>
    </div>

    <!-- Description -->
    <div class="form-group">
        <label for="description">Description</label>
        <input id= "description" class="form-input" name="description" type="text" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="description-warn" class="hide alert-text">Isi dulu description-nya woy</p>
        </i>
    </div>

    <!-- Birthdate -->
    <div class="form-group">
        <label for="birthdate">Birthdate</label>
        <input id = "birthdate" class="form-input" name="birthdate" type="date" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="birthdate-warn" class="hide alert-text">isi desc dulu!</p>
        </i>
    </div>

    <!-- Image -->
    <div class="form-group">
        <label for="photo">Photo</label>
        <input id = "photo" class="form-input" name="photo" type="file" placeholder="Sebuah Deskripsi"/>
        <i>
            <p id="photo-warn" class="hide alert-text">isi desc dulu!</p>
        </i>
    </div>

    <button class="btn btn-primary">Submit</button>
</form>

<!-- <div class="register-btn">
    <a href="/auth/register" class="btn alt-btn">tombol lain</a>
</div> -->
